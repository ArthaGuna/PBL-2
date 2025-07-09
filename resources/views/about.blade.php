<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Tentang Kami') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> /
                <span class="text-gray-600">Tentang Kami</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Gambar Utama --}}
            @if ($informasi?->gambar_utama)
            <div class="">
                <img src="{{ asset('storage/' . $informasi->gambar_utama) }}"
                    alt="Tentang Kami"
                    class="w-full max-h-[450px] object-cover rounded-lg shadow-md">
            </div>
            @endif

            {{-- Teks Tentang Kami --}}
            <div class="text-gray-700 text-base leading-relaxed whitespace-pre-line break-words text-justify">
                {{ $informasi?->tentang_kami }}
            </div>
        </div>
    </div>
</x-app-layout>