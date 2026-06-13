<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasboard Pelanggan</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-salon-text antialiased bg-salon-bg min-h-screen selection:bg-salon-gold selection:text-white"
    x-data="{ mobileMenuOpen: false }">

    <!-- Mobile Sidebar Drawer & Backdrop -->
    <div x-show="mobileMenuOpen" class="relative z-[100] lg:hidden" aria-labelledby="slide-over-title" role="dialog"
        aria-modal="true" style="display: none;">
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-salon-text bg-opacity-75 transition-opacity" @click="mobileMenuOpen = false"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <!-- Drawer -->
                <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-xs w-full pr-10">
                    <div x-show="mobileMenuOpen"
                        x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        class="pointer-events-auto relative w-screen max-w-sm">

                        <div class="flex h-full flex-col overflow-y-scroll bg-salon-cream shadow-2xl py-6">
                            <div
                                class="px-4 sm:px-6 flex items-center justify-between border-b border-salon-beige pb-4">
                                <a href="{{ route('home') }}" class="flex items-center gap-3">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                        class="h-10 w-auto object-contain">
                                    <span class="text-xl font-serif font-bold text-salon-gold tracking-tight">Eeva
                                        Salon</span>
                                </a>
                                <button type="button"
                                    class="relative rounded-md text-salon-text hover:text-salon-gold focus:outline-none focus:ring-2 focus:ring-salon-gold p-2"
                                    @click="mobileMenuOpen = false">
                                    <span class="absolute -inset-2.5"></span>
                                    <span class="sr-only">Tutup menu</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4 sm:px-6">
                                <div
                                    class="flex items-center gap-3 mb-6 bg-white p-3 rounded-xl border border-salon-beige shadow-sm">
                                    <div
                                        class="w-10 h-10 rounded-full bg-salon-gold text-white flex items-center justify-center font-bold text-lg">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-salon-text">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-salon-textLight">Pelanggan</p>
                                    </div>
                                </div>

                                <nav class="flex flex-1 flex-col space-y-2">
                                    <a href="{{ route('customer.dashboard') }}"
                                        class="{{ request()->routeIs('customer.dashboard') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-xl px-4 py-3 text-base font-medium transition">Dasboard
                                        Saya</a>
                                    {{-- <a href="{{ route('customer.reservations.index') }}"
                                        class="{{ request()->routeIs('customer.reservations.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-xl px-4 py-3 text-base font-medium transition">Riwayat
                                        Reservasi</a> --}}
                                    <a href="{{ route('profile.edit') }}"
                                        class="{{ request()->routeIs('profile.edit') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-xl px-4 py-3 text-base font-medium transition">Pengaturan
                                        Profil</a>
                                </nav>

                                <div class="mt-8 pt-8 border-t border-salon-beige">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 rounded-xl bg-white border border-red-200 px-4 py-3 text-base font-medium text-red-600 shadow-sm hover:bg-red-50 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Header -->
    <nav class="bg-salon-cream shadow-sm border-b border-salon-beige sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                        <a href="{{ route('home') }}"
                            class="text-xl font-serif font-bold text-salon-gold tracking-tight">
                            Eeva Salon
                        </a>
                    </div>
                    <div class="hidden lg:ml-10 lg:flex lg:space-x-8">
                        <a href="{{ route('customer.dashboard') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('customer.dashboard') ? 'border-salon-gold text-salon-gold' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition">Dasboard</a>
                        {{-- <a href="{{ route('customer.reservations.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('customer.reservations.*') ? 'border-salon-gold text-salon-gold' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition">Reservasi
                            Saya</a> --}}
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('profile.edit') ? 'border-salon-gold text-salon-gold' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition">Profil</a>
                    </div>
                </div>

                <!-- Desktop User Menu -->
                <div class="hidden lg:flex lg:items-center lg:ml-6">
                    <div class="ml-3 relative">
                        <div
                            class="flex items-center gap-4 bg-white px-4 py-2 rounded-full border border-salon-beige shadow-sm">
                            <div
                                class="w-8 h-8 rounded-full bg-salon-gold text-white flex items-center justify-center font-bold text-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-salon-text">{{ Auth::user()->name }}</span>
                            <div class="h-4 w-px bg-salon-beige mx-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="flex">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-medium text-salon-textLight hover:text-red-500 transition">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Hamburger Button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" @click="mobileMenuOpen = true"
                        class="inline-flex items-center justify-center p-2 rounded-md text-salon-text hover:text-salon-gold hover:bg-salon-beige focus:outline-none focus:ring-2 focus:ring-inset focus:ring-salon-gold transition"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg class="block h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white shadow-sm border-b border-salon-beige">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-serif font-bold text-2xl text-salon-text leading-tight">
                @yield('header', 'Dasboard Pelanggan')
            </h2>
            <a href="{{ route('home') }}"
                class="hidden sm:inline-flex text-sm font-medium text-salon-textLight hover:text-salon-gold transition items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Situs
            </a>
        </div>
    </header>

    <main class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative flex items-center"
                    role="alert">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative flex items-center"
                    role="alert">
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>

</html>