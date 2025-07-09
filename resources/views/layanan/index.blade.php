{{-- <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Layanan Kami') }}
</h2>
<div class="text-xs text-gray-500">
    <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span class="text-gray-600">Layanan</span>
</div>
</div>
</x-slot>

<div class="py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Gambar -->
        <div class="mb-8">
            <img src="{{ asset('img/services-hero.jpg') }}" alt="Layanan Kami" class="w-full h-auto rounded-lg shadow-md object-cover">
        </div>

        <!-- Daftar Layanan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($layanan as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_layanan }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->nama_layanan }}</h3>
                    <div class="text-gray-700 text-sm mb-3">
                        <span class="font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        @if($item->durasi) • {{ $item->durasi }} menit @endif
                    </div>
                    <p class="text-gray-600 text-sm text-justify mb-4">{{ Str::limit($item->deskripsi, 150) }}</p>
                    <a href="{{ route('layanan.show', $item->slug) }}" class="text-[#0288D1] hover:underline text-sm">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout> --}}