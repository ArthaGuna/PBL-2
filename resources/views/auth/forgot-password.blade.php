<x-guest-layout>

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Lupa Password</h1>
        <p class="text-gray-600 mt-1">Masukkan email akun Yeh Panes Penatahan kamu</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="max-w-md mx-auto">
        @csrf

        <!-- Email Address -->
        <div class="relative mb-6">
            <x-text-input id="email"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="email"
                placeholder=" " />
            <x-input-label for="email"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:text-sm peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1"
                :value="__('Email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white font-semibold rounded-lg py-2.5 px-4 transition duration-150 ease-in-out">
            {{ __('Kirim Link Reset Password') }}
        </button>
    </form>

    <!-- Back to Login -->
    <div class="mt-6 text-center mb-2">
        <a href="{{ route('login') }}"
            class="text-sm text-blue-600 hover:text-blue-700 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded">
            {{ __('Kembali ke Halaman Login') }}
        </a>
    </div>

</x-guest-layout>