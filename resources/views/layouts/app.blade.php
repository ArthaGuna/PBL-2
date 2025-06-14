<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')
        @livewire('chat-box')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
        
        @include('layouts.footer')
    </div>

    <!-- Pindahkan semua script ke bagian paling bawah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    @livewireScripts
    
    <!-- Tambahkan ini untuk suppress error multiple Alpine -->
    <script>
        window.deferLoadingAlpine = function() {
            return new Promise((resolve) => {
                window.addEventListener('livewire:init', () => {
                    resolve();
                });
            });
        };
    </script>
</body>
</html>