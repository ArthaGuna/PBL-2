<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Galeri Video') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> / <span
                    class="text-gray-600">Galeri Video</span>
            </div>
        </div>
    </x-slot>

    @livewire('galeri-video-page')
</x-app-layout>