<div>
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

    <!-- Loading spinner positioned below categories and shifted right -->
    <div wire:loading wire:target="pilihKategori" class="absolute flex justify-centerinset-0 z-50 mar top">
        {{-- <div class="w-8 h-8 border-4 border-gray-300 border-t-[#0288D1] rounded-full animate-spin"></div> --}}
    </div>

    <style>
        .mar {
            position: absolute;
            left: 50%;
        }

        .top {
            position: fixed;
            top: 50%;
        }
    </style>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6 transition-all duration-300"
        wire:loading.class="opacity-30" wire:target="pilihKategori">
        @forelse ($fotos as $foto)
            <div class="gallery-item">
                <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="{{ $foto->judul }}"
                        class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada foto di kategori ini.</p>
        @endforelse
    </div>
</div>