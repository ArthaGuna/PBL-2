<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
{
    public function proses(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'layanan' => 'required|exists:layanans,id',
                'tanggal' => 'required|date|after_or_equal:today',
                'waktu' => 'required|date_format:H:i',
                'jumlah_orang' => 'required|integer|min:1',
            ]);

            $layanan = Layanan::with('tiket')->findOrFail($validated['layanan']);

            if (!$layanan->tiket) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Layanan belum memiliki informasi tiket.',
                ], 422);
            }

            $hargaTiket = $layanan->tiket->harga;
            $totalHarga = $hargaTiket * $validated['jumlah_orang'];

            $reservasi = Reservasi::create([
                'user_id' => Auth::id(),
                'nama_pengunjung' => $validated['nama'],
                'layanan_id' => $layanan->id,
                'kode_booking' => 'ESPA-' . time() . '-' . Auth::id(),
                'tanggal_kunjungan' => $validated['tanggal'],
                'waktu_kunjungan' => $validated['waktu'],
                'jumlah_pengunjung' => $validated['jumlah_orang'],
                'total_harga' => $totalHarga,
                'total_bayar' => $totalHarga,
                'status_pembayaran' => 'pending',
                'stok_dikurangi' => false,
            ]);

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = config('midtrans.is3ds', true);

            // \Midtrans\Config::$curlOptions[CURLOPT_CAINFO] = 'D:/laragon/etc/ssl/cacert.pem';

            $params = [
                'transaction_details' => [
                    'order_id' => $reservasi->kode_booking,
                    'gross_amount' => (int) $totalHarga,
                ],
                'customer_details' => [
                    'first_name' => $validated['nama'],
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? '',
                ],
                'item_details' => [[
                    'id' => $layanan->id,
                    'price' => $hargaTiket,
                    'quantity' => $validated['jumlah_orang'],
                    'name' => $layanan->nama_layanan,
                ]],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $reservasi->update([
                'snap_token' => $snapToken,
                'midtrans_payment_type' => 'snap',
            ]);

            return response()->json([
                'status' => 'success',
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('Reservasi proses error', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses reservasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        Log::info('Midtrans notification received:', $request->all());

        try {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);

            $notif = new \Midtrans\Notification();

            // Log::info('Midtrans notification object:', (array) $notif);

            $transaction = $notif->transaction_status;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            $reservasi = Reservasi::where('kode_booking', $order_id)->firstOrFail();

            // Update status pembayaran
            if ($transaction === 'capture') {
                $reservasi->status_pembayaran = ($fraud === 'challenge') ? 'pending' : 'success';
            } elseif ($transaction === 'settlement') {
                $reservasi->status_pembayaran = 'success';
            } elseif ($transaction === 'pending') {
                $reservasi->status_pembayaran = 'pending';
            } elseif (in_array($transaction, ['deny'])) {
                $reservasi->status_pembayaran = 'failed';
            } elseif (in_array($transaction, ['cancel', 'expire'])) {
                $reservasi->status_pembayaran = 'cancelled';
            }

            $reservasi->update([
                'midtrans_transaction_id' => $notif->transaction_id,
                'midtrans_payment_type' => $notif->payment_type,
                'midtrans_transaction_status' => $transaction,
                'status_pembayaran' => $reservasi->status_pembayaran,
            ]);

            // Kurangi stok saat success, sekali saja
            if ($reservasi->status_pembayaran === 'success') {
                $reservasi->kurangiStokLayanan();
            }

            // Restore stok jika gagal/cancel dan sebelumnya sudah dikurangi
            if (in_array($reservasi->status_pembayaran, ['failed', 'cancelled']) && $reservasi->stok_dikurangi) {
                $reservasi->restoreStokLayanan();
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans notification error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Gagal memproses notifikasi'], 500);
        }
    }

    public function showForm()
    {
        $layanans = Layanan::where('status', true)->get(); // atau kamu bisa tambahkan filter lainnya
        return view('auth.payment.reservasi', compact('layanans'));
    }

    public function thankYou(Request $request)
    {
        $order_id = $request->get('order_id');
        $reservasi = Reservasi::where('kode_booking', $order_id)->first();

        if (!$reservasi || $reservasi->user_id !== Auth::id()) {
            return redirect()->route('reservasi')->with('error', 'Reservasi tidak valid atau tidak ditemukan.');
        }

        return view('auth.payment.thankyou', compact('reservasi'));
    }

    public function failed()
    {
        return view('auth.payment.failed');
    }

    public function history(Request $request)
    {
        $query = Reservasi::where('user_id', Auth::id())->latest();

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status_pembayaran', $request->status);
        }

        if ($request->has('tanggal') && $request->tanggal) {
            try {
                $bulan = Carbon::createFromFormat('Y-m', $request->tanggal);
                $query->whereMonth('tanggal_kunjungan', $bulan->month)
                    ->whereYear('tanggal_kunjungan', $bulan->year);
            } catch (\Exception $e) {
                // Invalid format, skip filter
            }
        }

        $reservasis = $query->get();

        return view('auth.payment.riwayat', compact('reservasis'));
    }
    public function detail($id)
    {
        $reservasi = Reservasi::with('layanan')->where('user_id', Auth::id())->findOrFail($id);
        return view('auth.payment.detail', compact('reservasi'));
    }
}
