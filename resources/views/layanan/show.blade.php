<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Detail Layanan') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> /
                <a href="{{ route('layanan.index') }}" class="hover:underline text-[#0288D1]">Layanan</a> /
                <span class="text-gray-600">Detail</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Gambar -->
            <div class="mb-8 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama_layanan }}" class="w-full h-auto object-cover">
            </div>

            <!-- Konten -->
            <div class="bg-white rounded-lg p-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $layanan->nama_layanan }}</h1>

                <div class="flex items-center mb-6 text-gray-700">
                    <span class="font-medium mr-4">
                        Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                    </span>
                    @if($layanan->durasi)
                        <span class="text-sm">• {{ $layanan->durasi }} menit</span>
                    @endif
                </div>

                <div class="text-gray-700 text-justify text-sm sm:text-base leading-relaxed space-y-4 mb-8">
                    {!! nl2br(e($layanan->deskripsi)) !!}
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('welcome') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-sm">
                        Kembali
                    </a>
                    <a href="{{ route('booking') }}" class="px-4 py-2 bg-[#0288D1] text-white rounded hover:bg-[#0277BD] transition text-sm">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
