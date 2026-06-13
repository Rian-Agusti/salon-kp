<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-serif font-bold text-salon-text">Buat Akun Baru</h2>
        <p class="text-sm text-salon-textLight mt-2">Daftar untuk mulai reservasi layanan kami</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold" type="text"
                name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" value="Nomor Telepon" />
            <x-text-input id="phone" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold" type="text"
                name="phone" :value="old('phone')" autocomplete="tel" placeholder="Contoh: 08123456789" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata Sandi" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold"
                type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full focus:border-salon-gold focus:ring-salon-gold" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center bg-salon-gold hover:bg-salon-goldHover focus:ring-salon-gold">
                Daftar
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-sm text-salon-textLight">
            Sudah punya akun?
            <a href="{{ route('login') }}"
                class="font-medium text-salon-gold hover:text-salon-goldHover transition">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>