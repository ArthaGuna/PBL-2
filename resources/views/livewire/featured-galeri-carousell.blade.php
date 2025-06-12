<div>
    <div class="flex items-center justify-center space-x-6 overflow-hidden px-4">
        {{-- Tombol Sebelumnya --}}
        <button id="prevBtn" class="text-blue-500 hover:text-blue-700 text-2xl focus:outline-none z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        {{-- Galeri --}}
        <div id="galleryContainer" class="overflow-x-auto no-scrollbar">
            <div id="galleryImages" class="flex gap-6 transition-transform duration-500 ease-in-out w-max">
                @foreach ($fotos as $foto)
                    <img src="{{ asset('storage/' . $foto->path_foto) }}"
                        class="w-80 h-52 rounded-lg shadow-md object-cover flex-shrink-0" alt="{{ $foto->judul }}">
                @endforeach
            </div>
        </div>

        {{-- Tombol Selanjutnya --}}
        <button id="nextBtn" class="text-blue-500 hover:text-blue-700 text-2xl focus:outline-none z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gallery = document.getElementById('galleryContainer');
            const next = document.getElementById('nextBtn');
            const prev = document.getElementById('prevBtn');

            next.addEventListener('click', () => {
                gallery.scrollBy({ left: 350, behavior: 'smooth' });
            });

            prev.addEventListener('click', () => {
                gallery.scrollBy({ left: -350, behavior: 'smooth' });
            });
        });
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>