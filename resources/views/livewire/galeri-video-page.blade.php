<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8 relative">

    {{-- Efek blur saat loading --}}
    <div class="transition duration-300" wire:loading.delay.class="blur-sm pointer-events-none select-none">

        <!-- Video Utama -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-10">
            <div class="aspect-w-16 aspect-h-9">
                @if ($videoUtama->jenis === 'embed' && $videoUtama->getEmbedUrl())
                    <iframe class="w-full h-96" src="{{ $videoUtama->getEmbedUrl() }}"
                        title="{{ $videoUtama->judul }}" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @elseif ($videoUtama->jenis === 'upload' && $videoUtama->path_video)
                    <video class="w-full h-96" controls muted>
                        <source src="{{ asset('storage/' . $videoUtama->path_video) }}" type="video/mp4">
                        Browser tidak mendukung video.
                    </video>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $videoUtama->judul }}</h3>
            </div>
        </div>

        <!-- Rekomendasi Video -->
        {{-- <div class="mt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Rekomendasi Video</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($rekomendasi as $video)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:ring-2 ring-blue-400"
                        wire:click="pilihVideo({{ $video->id }})" wire:loading.attr="disabled">
                        <div class="aspect-w-16 aspect-h-9">
                            @if ($video->jenis === 'embed' && $video->getEmbedUrl())
                                <iframe class="w-full h-40" src="{{ $video->getEmbedUrl() }}"
                                    title="{{ $video->judul }}" frameborder="0"
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @elseif ($video->jenis === 'upload' && $video->path_video)
                                <video class="w-full h-40" muted>
                                    <source src="{{ asset('storage/' . $video->path_video) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                        <div class="p-3">
                            <p class="text-sm font-semibold text-gray-700 mb-1 truncate">{{ $video->judul }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>

    {{-- Blur overlay saat loading --}}
    <div wire:loading.delay class="absolute inset-0 bg-white bg-opacity-50 z-40 rounded-lg"></div>
</div>