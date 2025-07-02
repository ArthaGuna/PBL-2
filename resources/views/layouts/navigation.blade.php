<nav x-data="{ 
        open: false, 
        scrolled: false, 
        lastScroll: 0,
        ticking: false 
    }" x-init="
        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                    
                    // Tambahkan threshold untuk mencegah getaran
                    const threshold = 10;
                    
                    if (currentScroll <= threshold) {
                        scrolled = false;
                    } else if (currentScroll > lastScroll + threshold && currentScroll > 80) {
                        // Scroll down dengan threshold lebih besar
                        scrolled = true;
                    } else if (currentScroll < lastScroll - threshold) {
                        // Scroll up dengan threshold
                        scrolled = false;
                    }
                    
                    lastScroll = Math.max(0, currentScroll);
                    ticking = false;
                });
                ticking = true;
            }
        };
        
        window.addEventListener('scroll', handleScroll, { passive: true });
    " class="bg-white sticky top-0 z-50 transition-all duration-500 ease-in-out"
    :class="{ 'shadow-md': lastScroll > 10 }">

    <!-- Top Bar with Social Media and Contact - Hidden when scrolled down -->
    <div class="bg-gray-100 transition-all duration-500 ease-in-out transform"
        :class="scrolled ? 'h-0 opacity-0 overflow-hidden -translate-y-2' : 'h-10 opacity-100 translate-y-0'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex items-center justify-end space-x-4">
            <!-- Social Media Links -->
            <a href="https://www.instagram.com/yehpanaspenatahan/"
                class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <span class="sr-only">Instagram</span>
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 3.807.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-3.807v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <a href="https://www.facebook.com/yehpanespenatahan"
                class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <span class="sr-only">Facebook</span>
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <span class="text-gray-600">|</span>
            <a href="https://wa.me/6281237404325"
                class="text-gray-600 hover:text-gray-900 flex items-center transition-colors duration-200">
                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                +62 812-3740-4325
            </a>
        </div>
    </div>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links (Centralized) -->
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
                <div class="flex space-x-8">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('Tentang Kami') }}
                    </x-nav-link>

                    <!-- Galeri Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open"
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-200">
                            {{ __('Galeri') }}
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <x-dropdown-link href="{{ route('galeri.foto') }}"
                                    :active="request()->routeIs('galeri.foto')">
                                    {{ __('Galeri Foto') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('galeri.video') }}"
                                    :active="request()->routeIs('galeri.video')">
                                    {{ __('Galeri Video') }}
                                </x-dropdown-link>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open"
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-200">
                            {{ __('Layanan') }}
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                @forelse(App\Models\Layanan::where('status', true)->get() as $layanan)
                                    <x-dropdown-link href="{{ route('layanan.show', $layanan->id) }}">
                                        {{ $layanan->nama_layanan }}
                                    </x-dropdown-link>
                                @empty
                                    <x-dropdown-link href="#">
                                        Belum ada layanan
                                    </x-dropdown-link>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open"
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-200">
                            {{ __('Fasilitas') }}
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                @forelse(App\Models\Fasilitas::where('status', true)->get() as $fasilitas)
                                    <x-dropdown-link href="{{ route('fasilitas.show', $fasilitas->id) }}">
                                        {{ $fasilitas->nama_fasilitas }}
                                    </x-dropdown-link>
                                @empty
                                    <x-dropdown-link href="#">
                                        Belum ada fasilitas
                                    </x-dropdown-link>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">

                        <!-- BELI TIKET Button -->
                        @auth
                            <!-- Desktop BELI TIKET Button for Authenticated Users -->
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <a href="{{ route('reservasi') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-lg font-semibold text-xs text-white uppercase tracking-widest 
                                    hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition ease-in-out duration-150">
                                    {{ __('BELI TIKET') }}
                                </a>
                            </div>
                        @else
                            <!-- Desktop BELI TIKET Button for Guest Users -->
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-lg font-semibold text-xs text-white uppercase tracking-widest 
                                hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition ease-in-out duration-150">
                                {{ __('BELI TIKET') }}
                            </a>
                        @endauth

                        @auth
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>
                                                <p>Halo, {{ Auth::user()->name }}
                                                </p>
                                            </div>
                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Edit Profil') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('Keluar') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endauth

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('Tentang Kami') }}
                    </x-responsive-nav-link>

                    <!-- Mobile Galeri Dropdown -->
                    <div x-data="{ open: false }" class="px-4 pt-2">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition duration-200">
                            <span>{{ __('Galeri') }}</span>
                            <svg class="ml-2 h-5 w-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="pl-4">
                            <x-responsive-nav-link href="{{ route('galeri.foto') }}"
                                :active="request()->routeIs('galeri.foto')">
                                {{ __('Galeri Foto') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('galeri.video') }}"
                                :active="request()->routeIs('galeri.video')">
                                {{ __('Galeri Video') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>

                    <!-- Mobile Layanan Dropdown -->
                    <div x-data="{ open: false }" class="px-4 pt-2">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition duration-200">
                            <span>{{ __('Layanan') }}</span>
                            <svg class="ml-2 h-5 w-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="pl-4">
                            @forelse(App\Models\Layanan::where('status', true)->get() as $layanan)
                                <x-responsive-nav-link href="{{ route('layanan.show', $layanan->id) }}">
                                    {{ $layanan->nama_layanan }}
                                </x-responsive-nav-link>
                            @empty
                                <x-responsive-nav-link href="#">
                                    Belum ada layanan
                                </x-responsive-nav-link>
                            @endforelse
                        </div>
                    </div>

                    <!-- Mobile Fasilitas Dropdown -->
                    <div x-data="{ open: false }" class="px-4 pt-2">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition duration-200">
                            <span>{{ __('Fasilitas') }}</span>
                            <svg class="ml-2 h-5 w-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="pl-4">
                            @forelse(App\Models\Fasilitas::where('status', true)->get() as $fasilitas)
                                <x-responsive-nav-link href="{{ route('fasilitas.show', $fasilitas->id) }}">
                                    {{ $fasilitas->nama_fasilitas }}
                                </x-responsive-nav-link>
                            @empty
                                <x-responsive-nav-link href="#">
                                    Belum ada fasilitas
                                </x-responsive-nav-link>
                            @endforelse
                        </div>
                    </div>

                    <!-- Mobile BELI TIKET Button -->
                    <div class="px-4 pt-2">
                        @auth
                            <!-- Mobile BELI TIKET Button for Authenticated Users -->
                            <a href="{{ route('booking') }}"
                                class="block w-full px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest text-center hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('BELI TIKET') }}
                            </a>
                        @else
                            <!-- Mobile BELI TIKET Button for Guest Users -->
                            <a href="{{ route('login') }}"
                                class="block w-full px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest text-center hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('BELI TIKET') }}
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Responsive Settings Options -->
                @auth
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Edit Profil') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
</nav>