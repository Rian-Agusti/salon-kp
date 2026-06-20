<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-serif font-bold text-salon-text">Selamat Datang Kembali</h2>
        <p class="text-sm text-salon-textLight mt-2">Silakan masuk ke akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata Sandi" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold"
                type="password" name="password" required autocomplete="current-password"
                placeholder="Masukkan kata sandi Anda" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-salon-gold shadow-sm focus:ring-salon-gold" name="remember">
                <span class="ms-2 text-sm text-salon-textLight">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-salon-gold hover:text-salon-goldHover transition"
                    href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center bg-salon-gold hover:bg-salon-goldHover focus:ring-salon-gold">
                Masuk
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm text-salon-textLight">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-medium text-salon-gold hover:text-salon-goldHover transition">Daftar sekarang</a>
            </div>
        @endif
    </form>
</x-guest-layout>