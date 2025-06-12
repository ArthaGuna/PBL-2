<div>
    <!-- Filter Kategori -->
    <div class="mb-8 overflow-x-auto">
        <div class="flex space-x-4 pb-2">
            @foreach($categories as $key => $label)
                <button wire:click="pilihKategori('{{ $key }}')" wire:loading.attr="disabled" wire:target="pilihKategori"
                    class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap
                            {{ $kategoriTerpilih === $key ? 'bg-[#0288D1] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading wire:target="pilihKategori" class="fixed inset-0 z-50 flex items-center justify-center ">
        <div class="w-12 h-12 border-4 border-gray-300 border-t-[#0288D1] rounded-full animate-spin"></div>
    </div>

    <!-- Grid Foto -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6 transition-all duration-300"
        wire:loading.class="opacity-30" wire:target="pilihKategori">
        @forelse ($fotos as $foto)
            <div class="gallery-item group cursor-pointer relative" 
                 wire:click="tampilkanFoto({{ $foto->id }})">
                <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="{{ $foto->judul }}"
                        class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                    <!-- Overlay dengan efek hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                Belum ada foto di kategori ini.
            </div>
        @endforelse
    </div>

    <!-- Modal Lightbox (Sederhana) -->
    @if($showModal && $fotoTerpilih)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data>
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" wire:click="tutupModal"></div>

            <!-- Modal Container -->
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <!-- Modal Content -->
                <div class="inline-block align-bottom rounded-lg text-left overflow-hidden transform transition-all w-full max-w-5xl">
                    <!-- Close Button -->
                    <button 
                        class="absolute top-4 right-4 text-white hover:text-gray-200 z-50"
                        wire:click="tutupModal"
                    >
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Navigation Arrows -->
                    <button 
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-200 z-50 bg-black bg-opacity-50 rounded-full p-2"
                        wire:click="fotoSebelumnya"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-200 z-50 bg-black bg-opacity-50 rounded-full p-2"
                        wire:click="fotoBerikutnya"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Foto dengan Kategori Saja -->
                    <div class="relative">
                        <img 
                            src="{{ asset('storage/' . $fotoTerpilih->path_foto) }}" 
                            alt="{{ $fotoTerpilih->judul }}"
                            class="w-full max-h-[80vh] object-contain mx-auto"
                        >
                        <!-- Hanya menampilkan kategori -->
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-2 text-center">
                            <p class="text-sm">{{ $categories[$fotoTerpilih->kategori] ?? $fotoTerpilih->kategori }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>