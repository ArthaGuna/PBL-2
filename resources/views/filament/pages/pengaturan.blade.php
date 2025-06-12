@if (session('success'))
    <div class="filament-notification-success filament-notification" role="alert" style="margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<x-filament::page>
    {{ $this->form }}

    <x-filament::button wire:click="submit" class="mt-4">
        Simpan Pengaturan
    </x-filament::button>
</x-filament::page>