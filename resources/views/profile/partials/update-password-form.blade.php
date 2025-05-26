<section>
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-gray-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                          class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-gray-700" />
            <x-text-input id="update_password_password" name="password" type="password" 
                          class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-gray-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                          class="mt-2 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 mt-6">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-lg font-semibold text-xs text-white uppercase tracking-widest 
                    hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition ease-in-out duration-150">
                {{ __('Perbarui Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    {{ __('Password updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>