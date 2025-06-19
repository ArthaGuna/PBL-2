<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Fasilitas Kami') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span
                    class="text-gray-600">fasilitas</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($fasilitas->count() > 0)
                @foreach($fasilitas as $item)
                    <div class="mb-12 bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Gambar Fasilitas -->
                        <div class="h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}"
                                class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Konten Fasilitas -->
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                @if($item->icon)
                                    <img src="{{ asset('storage/' . $item->icon) }}" alt="Icon" class="w-8 h-8 mr-3">
                                @endif
                                <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_fasilitas }}</h3>
                            </div>
                            
                            <div class="text-gray-700 text-justify leading-relaxed">
                                {!! nl2br(e($item->deskripsi)) !!}
                            </div>
                            
                            @if($item->is_featured)
                                <span class="inline-block mt-4 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                    Fasilitas Unggulan
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600">Belum ada fasilitas yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>