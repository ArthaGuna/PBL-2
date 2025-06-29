<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
{
    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'layanan' => 'required|in:umum,jacuzzi',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => 'required|date_format:H:i',
            'jumlah_orang' => 'required|integer|min:1', 
            'total_harga' => 'required|numeric|min:0',
        ]);

        $harga = $validated['layanan'] === 'umum' ? 50000 : 150000;
        $totalHarga = $harga * $validated['jumlah_orang'];

        $reservasi = Reservasi::create([
            'user_id' => Auth::id(),
            'kode_booking' => 'ESPA-' . time() . '-' . Auth::id(),
            'tanggal_kunjungan' => $validated['tanggal'], 
            'waktu_kunjungan' => $validated['waktu'], 
            'jumlah_pengunjung' => $validated['jumlah_orang'], 
            'total_harga' => $totalHarga, 
            'total_bayar' => $totalHarga, 
            'status_pembayaran' => 'pending',
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $reservasi->kode_booking,
                'gross_amount' => $reservasi->total_bayar, 
            ],
            'customer_details' => [
                'first_name' => $validated['nama'],
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => $validated['layanan'],
                    'price' => $harga,
                    'quantity' => $validated['jumlah_orang'],
                    'name' => $validated['layanan'] === 'umum' ? 'Pemandian Air Panas Umum' : 'Jacuzzi Private',
                ]
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $reservasi->update([
                'snap_token' => $snapToken,
                'midtrans_payment_type' => 'snap',
            ]);

            return response()->json([
                'status' => 'success',
                'snapToken' => $snapToken,
                'reservasi' => $reservasi,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error', [
                'message' => $e->getMessage(),
                'params' => $params,
                'reservasi_id' => $reservasi->id ?? null
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Pembayaran gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        try {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);

            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            $reservasi = Reservasi::where('kode_booking', $order_id)->firstOrFail();

            if ($transaction == 'capture') {
                if ($fraud == 'challenge') {
                    $reservasi->status_pembayaran = 'pending';
                } else {
                    $reservasi->status_pembayaran = 'paid';
                }
            } elseif ($transaction == 'settlement') {
                $reservasi->status_pembayaran = 'paid';
            } elseif ($transaction == 'pending') {
                $reservasi->status_pembayaran = 'pending';
            } elseif ($transaction == 'deny') {
                $reservasi->status_pembayaran = 'failed';
            } elseif ($transaction == 'expire') {
                $reservasi->status_pembayaran = 'cancelled';
            } elseif ($transaction == 'cancel') {
                $reservasi->status_pembayaran = 'cancelled';
            }

            $reservasi->update([
                'midtrans_transaction_id' => $notif->transaction_id,
                'midtrans_payment_type' => $notif->payment_type,
                'midtrans_transaction_status' => $transaction,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status pembayaran berhasil diperbarui.',
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans notification error', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error processing notification'
            ], 500);
        }
    }
}