<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black leading-tight">
                {{ __('Galeri Foto') }}
            </h2>
            <div class="text-xs text-gray-500">
                <a href="{{ url('/') }}" class="hover:underline text-[#0288D1]">Beranda</a> /
                <span class="text-gray-600">Galeri Foto</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        @livewire('galeri-foto-page')
    </div>

    @push('scripts')
        <script>
            document.addEventListener('keydown', function(event) {
                // Tutup modal dengan ESC
                if (event.key === 'Escape') {
                    Livewire.emit('tutupModal');
                }
                
                // Navigasi dengan panah kiri/kanan
                if (event.key === 'ArrowLeft') {
                    Livewire.emit('fotoSebelumnya');
                } else if (event.key === 'ArrowRight') {
                    Livewire.emit('fotoBerikutnya');
                }
            });
        </script>
    @endpush
</x-app-layout>