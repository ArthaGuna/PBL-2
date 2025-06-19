<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot> --}}

    {{-- Hero Image--}}
    <div class="w-full relative">
        <img src="{{ asset('img/main-3.png') }}" alt="Hero Image" class="w-full h-auto object-cover">
    </div>

    {{-- Teks --}}
    <div class="text-center mt-12 px-5">
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-black">
            Temukan ketenangan alami bersama <span class="text-blue-600 dark:text-blue-500">suasana terbaik</span> untuk
            hari Anda.
        </h1>
        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
            Nikmati kenyamanan, kehangatan, dan kedamaian yang menyatu dalam setiap momen.
        </p>
        <div class="mx-auto mt-4 w-32 h-1 bg-blue-500 rounded"></div>
    </div>

    {{-- Cards --}}
    <div class="mt-8 max-w-7xl mx-auto px-5 grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach(App\Models\Layanan::where('status', true)->limit(3)->get() as $layanan)
            <div class="bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('layanan.show', $layanan->id) }}">
                    <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama_layanan }}" />
                </a>
                <div class="p-5">
                    <a href="{{ route('layanan.show', $layanan->id) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $layanan->nama_layanan }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">
                        {{ Str::limit($layanan->deskripsi, 100) }}
                    </p>
                    <a href="{{ route('layanan.show', $layanan->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Lihat selengkapnya
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Galeri Kami --}}
    <section class="bg-gray-200 py-12 mt-16">
        <div class="max-w-7xl mx-auto px-5 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Galeri Kami</h2>
            <div class="mx-auto mb-8 w-16 h-1 bg-blue-500 rounded"></div>
            @livewire('featured-galeri-carousell')
        </div>
    </section>
</x-app-layout>