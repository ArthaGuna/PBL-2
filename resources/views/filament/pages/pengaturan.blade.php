<x-filament::page>
    @if (session('success'))
    <div
        class="filament-notification-success filament-notification"
        role="alert"
        style="margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Simpan Pengaturan
        </x-filament::button>
    </form>
</x-filament::page>