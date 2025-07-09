<footer class="bg-[#003366] text-white mt-10">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">

            {{-- Logo --}}
            <div class="flex md:items-start justify-center md:justify-start">
                @if ($informasi?->logo)
                <img src="{{ asset('storage/' . $informasi->logo) }}" class="h-24" alt="Logo">
                @else
                <span class="text-gray-400">Belum ada logo</span>
                @endif
            </div>

            {{-- Tentang Kami --}}
            <div>
                <h2 class="text-lg font-semibold">Tentang Kami</h2>
                <p class="text-sm text-gray-300 mb-3 whitespace-pre-line break-words line-clamp-4">
                    {{ $informasi?->tentang_kami ? Str::limit(strip_tags($informasi->tentang_kami), 150) : 'Belum ada informasi.' }}
                </p>
                <a href="{{ route('about') }}" class="text-sm underline hover:text-gray-100">Lihat selengkapnya...</a>
            </div>

            {{-- Kontak Kami --}}
            <div>
                <h2 class="text-lg font-semibold mb-3">Kontak Kami</h2>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li>
                        <a href="{{ $sosmed['wa'] ?? '#' }}" class="hover:text-white" target="_blank" rel="noopener noreferrer">
                            WhatsApp
                        </a>
                    </li>
                    <li>
                        <a href="{{ $sosmed['facebook'] ?? '#' }}" class="hover:text-white" target="_blank" rel="noopener noreferrer">
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a href="{{ $sosmed['instagram'] ?? '#' }}" class="hover:text-white" target="_blank" rel="noopener noreferrer">
                            Instagram
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Jam Operasional --}}
            <div>
                <h2 class="text-lg font-semibold mb-3">Jam Operasional</h2>
                <p class="text-sm text-gray-300">
                    {{ $informasi?->jam_buka ?? 'Setiap hari 07.00 - 19.00 WITA' }}
                </p>
            </div>

            {{-- Temukan Kami --}}
            <div>
                <h2 class="text-lg font-semibold mb-3">Temukan Kami</h2>
                <div class="w-full h-48 rounded shadow overflow-hidden">
                    @if ($informasi?->maps_embed_url)
                    <iframe
                        src="{{ $informasi->maps_embed_url }}"
                        width="600"
                        height="400"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    @else
                    <div class="text-sm text-gray-400">Belum ada peta lokasi.</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="bg-[#002244] py-4 mt-6">
        <div class="text-center text-sm text-gray-400">
            © {{ now()->year }} Yeh Panes Penatahan. All Rights Reserved.
        </div>
    </div>
</footer>