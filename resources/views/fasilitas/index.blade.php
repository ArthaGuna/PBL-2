<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Fasilitas Kami') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span class="text-gray-600">Fasilitas</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Gambar -->
            <div class="mb-8">
                <img src="{{ asset('img/facilities-hero.jpg') }}" alt="Fasilitas Kami" class="w-full h-auto rounded-lg shadow-md object-cover">
            </div>

            @if($fasilitas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($fasilitas as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                @if($item->icon)
                                    <img src="{{ asset('storage/' . $item->icon) }}" alt="Icon" class="w-6 h-6 mr-2">
                                @endif
                                <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_fasilitas }}</h3>
                            </div>
                            <p class="text-gray-600 text-sm text-justify mb-4">{{ Str::limit($item->deskripsi, 150) }}</p>
                            @if($item->is_featured)
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold mb-3">
                                    Unggulan
                                </span>
                            @endif
                            <a href="{{ route('fasilitas.show', $item->id) }}" class="text-[#0288D1] hover:underline text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600">Belum ada fasilitas yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>