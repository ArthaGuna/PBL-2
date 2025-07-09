<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Reservasi</h1>
            <div class="text-xs text-gray-500">
                <a href="{{ route('home') }}" class="text-[#0288D1] hover:underline">Beranda /</a>
                <a href="{{ route('payment.riwayat') }}" class="text-[#0288D1] hover:underline">Riwayat Pembayaran /</a>
                <span class="text-gray-600">Detail</span>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
                <!-- Status Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Reservasi #{{ $reservasi->kode_booking }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Dibuat pada {{ $reservasi->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($reservasi->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($reservasi->status_pembayaran === 'success') bg-green-100 text-green-800
                        @elseif($reservasi->status_pembayaran === 'cancelled' || $reservasi->status_pembayaran === 'failed') bg-gray-100 text-gray-800
                        @endif">
                        {{ $reservasi->status_pembayaran === 'pending' ? 'Menunggu Pembayaran' : ucfirst($reservasi->status_pembayaran) }}
                    </span>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Left Column: Booking Details -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Reservasi</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Layanan</p>
                                <p class="font-medium">{{ $reservasi->layanan->nama_layanan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal & Waktu</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->format('d M Y') }} •
                                    {{ \Carbon\Carbon::parse($reservasi->waktu_kunjungan)->format('H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Pengunjung</p>
                                <p class="font-medium">{{ $reservasi->jumlah_pengunjung }} orang</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Pemesan</p>
                                <p class="font-medium">{{ $reservasi->nama_pengunjung }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Payment Details -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pembayaran</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Subtotal</p>
                                <p class="font-medium">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Metode Pembayaran</p>
                                <p class="font-medium">{{ ucfirst($reservasi->midtrans_payment_type ?? '-') }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Status Pembayaran</p>
                                <p class="font-medium">
                                    {{ $reservasi->status_pembayaran === 'pending' ? 'Menunggu Pembayaran' : ucfirst($reservasi->status_pembayaran) }}
                                </p>
                            </div>
                            <div class="pt-3 border-t">
                                <div class="flex justify-between">
                                    <p class="font-semibold">Total Pembayaran</p>
                                    <p class="text-lg font-bold text-blue-600">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions (only if pending) -->
                @if($reservasi->status_pembayaran === 'pending')
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-2">Instruksi Pembayaran</h3>
                    <p class="text-sm text-yellow-700 mb-3">
                        Silakan selesaikan pembayaran Anda sebelum {{ $reservasi->created_at->addDay()->format('d M Y H:i') }} untuk menghindari pembatalan otomatis.
                    </p>
                    <a href="{{ route('reservasi') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                        Lanjutkan Pembayaran
                    </a>
                </div>
                @endif

                <!-- Important Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Informasi Penting</h3>
                    <ul class="list-disc list-inside text-sm text-blue-700 space-y-1">
                        <li>Tunjukkan kode booking <strong>#{{ $reservasi->kode_booking }}</strong> kepada petugas saat check-in</li>
                        <li>Datanglah 15 menit sebelum waktu reservasi Anda</li>
                        <li>Batalkan reservasi minimal 1 hari sebelumnya untuk mendapatkan refund</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('payment.riwayat') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
                        Kembali ke Riwayat
                    </a>
                    @if($reservasi->status_pembayaran === 'pending')
                    <a href="{{ route('reservasi') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                        Bayar Sekarang
                    </a>
                    @endif
                    <button onclick="window.print()" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
                        Cetak Tiket
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>