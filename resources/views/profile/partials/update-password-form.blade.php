<section>
    <header>
        <h2 class="text-xl font-serif font-bold text-salon-text">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-salon-textLight">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Kata Sandi Saat Ini" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full focus:border-salon-gold focus:ring-salon-gold"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Kata Sandi Baru" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full focus:border-salon-gold focus:ring-salon-gold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full focus:border-salon-gold focus:ring-salon-gold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-salon-gold hover:bg-salon-goldHover focus:ring-salon-gold">{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'password-updated' || session('success'))
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium">{{ session('success') ?? __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
    @if (session('status') === 'password-updated' || session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-[9999] flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') ?? __('Password Berhasil Diubah') }}</span>
        </div>
    @endif

    @if ($errors->updatePassword->any() || $errors->hasAny(['current_password', 'password', 'password_confirmation']) || session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-[9999] flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span>{{ session('error') ?? __('Password Gagal Diubah') }}</span>
        </div>
    @endif

</section>
