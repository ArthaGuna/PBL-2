<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Konfirmasi Pembayaran') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> /
                <a href="{{ url('/reservasi') }}" class="hover:underline text-[#0288D1]">Beli Tiket</a> /
                <span class="text-gray-600">Konfirmasi Pembayaran</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-10 bg-white border-b border-gray-200">
                    <!-- Icon -->
                    <div class="text-center mb-6">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                            <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h1 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-4">Pembayaran Berhasil!</h1>

                    <p class="text-center text-gray-600 mb-8">Terima kasih telah melakukan pembayaran. Reservasi Anda
                        telah dikonfirmasi.</p>

                    <!-- Detail -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Reservasi</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Kode Booking</p>
                                <p class="font-medium text-lg text-blue-600">{{ $reservasi->kode_booking }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Pengunjung</p>
                                <p class="font-medium">{{ $reservasi->nama_pengunjung }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jenis Layanan</p>
                                <p class="font-medium">{{ $reservasi->layanan->nama_layanan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status Pembayaran</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $reservasi->status_pembayaran === 'success' ? 'bg-green-100 text-green-800' :
    ($reservasi->status_pembayaran === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($reservasi->status_pembayaran) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Kunjungan</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Waktu Kunjungan</p>
                                <p class="font-medium">{{ $reservasi->waktu_kunjungan }} WIB</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Pengunjung</p>
                                <p class="font-medium">{{ $reservasi->jumlah_pengunjung }} orang</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Reservasi</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservasi->created_at)->translatedFormat('d F Y, H:i') }}
                                    WIB</p>
                            </div>
                            <div class="md:col-span-2 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                                        <p class="text-xl font-bold text-blue-600">Rp
                                            {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Metode Pembayaran</p>
                                        <p class="text-sm font-medium">
                                            {{ $reservasi->midtrans_payment_type ? ucfirst(str_replace('_', ' ', $reservasi->midtrans_payment_type)) : 'Online Payment' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instruksi -->
                    <div class="bg-blue-50 rounded-lg p-6 mb-8 border border-blue-100">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3">Instruksi Penting</h3>
                        <ul class="list-disc pl-5 space-y-2 text-blue-700 text-sm">
                            <li>Tunjukkan kode booking <strong>{{ $reservasi->kode_booking }}</strong> saat check-in
                            </li>
                            <li>Datang 15 menit sebelum waktu reservasi Anda</li>
                            <li>Simpan atau cetak bukti pembayaran ini sebagai referensi</li>
                            <li>Bawa identitas diri yang valid (KTP/SIM/Passport)</li>
                            <li>Hubungi customer service jika perlu bantuan</li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-8 border border-gray-200">
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Butuh Bantuan?</h4>
                        <p class="text-sm text-gray-600">
                            Hubungi kami di <strong>+62 123 456 789</strong> atau <strong>info@espabali.com</strong>
                        </p>
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('home') }}"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center transition font-medium">
                            Kembali ke Beranda
                        </a>
                        <button onclick="window.print()"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center transition font-medium">
                            Cetak Bukti Reservasi
                        </button>
                        <a href="{{ route('reservasi') }}"
                            class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 text-center transition font-medium">
                            Buat Reservasi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.scrollTo(0, 0);
            document.querySelector('.bg-white.overflow-hidden').classList.add('print-area');
            const buttons = document.querySelectorAll('a[href], button');
            buttons.forEach(btn => {
                if (btn.onclick && btn.onclick.toString().includes('print')) return;
                btn.classList.add('no-print');
            });
        });
    </script>
</x-app-layout>