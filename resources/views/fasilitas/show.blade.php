<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Detail Fasilitas') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / 
                <a href="{{ route('fasilitas.index') }}" class="hover:underline text-[#0288D1]">Fasilitas</a> / 
                <span class="text-gray-600">Detail</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Gambar -->
            <div class="mb-8 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $fasilitas->gambar) }}" alt="{{ $fasilitas->nama_fasilitas }}" class="w-full h-auto object-cover">
            </div>

            <!-- Konten -->
            <div class="bg-white rounded-lg -md p-8">
                <div class="flex items-center mb-6">
                    @if($fasilitas->icon)
                        <img src="{{ asset('storage/' . $fasilitas->icon) }}" alt="Icon" class="w-8 h-8 mr-3">
                    @endif
                    <h1 class="text-2xl font-bold text-gray-800">{{ $fasilitas->nama_fasilitas }}</h1>
                </div>
                
                @if($fasilitas->is_featured)
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full font-semibold mb-6">
                        Fasilitas Unggulan
                    </span>
                @endif
                
                <div class="text-gray-700 text-justify text-sm sm:text-base leading-relaxed space-y-4 mb-8">
                    {!! nl2br(e($fasilitas->deskripsi)) !!}
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>