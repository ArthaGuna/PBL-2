<x-app-layout>
    @forelse ($reservasis as $reservasi)
    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
            <div>
                <h3 class="font-semibold text-gray-800">{{ $reservasi->kode_booking }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $reservasi->created_at->format('d M Y H:i') }}</p>
            </div>
            <span class="px-3 py-1 text-xs font-medium rounded-full
                    @if($reservasi->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($reservasi->status_pembayaran === 'success') bg-green-100 text-green-800
                    @elseif($reservasi->status_pembayaran === 'cancelled' || $reservasi->status_pembayaran === 'failed') bg-gray-100 text-gray-800
                    @endif">
                {{ ucfirst($reservasi->status_pembayaran) === 'Pending' ? 'Menunggu Pembayaran' : ucfirst($reservasi->status_pembayaran) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <p class="text-sm text-gray-500">Layanan</p>
                <p class="font-medium">{{ $reservasi->layanan->nama_layanan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Kunjungan</p>
                <p class="font-medium">
                    {{ \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->format('d M Y') }} •
                    {{ \Carbon\Carbon::parse($reservasi->waktu_kunjungan)->format('H:i') }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Jumlah Orang</p>
                <p class="font-medium">{{ $reservasi->jumlah_pengunjung }} orang</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <p class="text-sm text-gray-500">Total Pembayaran</p>
                <p class="text-lg font-bold text-blue-600">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</p>
            </div>
            <div class="flex space-x-2">
                @if ($reservasi->status_pembayaran === 'pending')
                <a href="{{ route('reservasi') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                    Bayar Sekarang
                </a>
                @endif
                <a href="{{ route('payment.detail', $reservasi->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50">
                    Detail
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada riwayat pembayaran</h3>
        <p class="mt-1 text-sm text-gray-500">Anda belum melakukan reservasi apapun.</p>
        <div class="mt-6">
            <a href="{{ route('reservasi') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                Buat Reservasi Sekarang
            </a>
        </div>
    </div>
    @endforelse
</x-app-layout>