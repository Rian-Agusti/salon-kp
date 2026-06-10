<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->salon_name ?? config('app.name', 'Eeva Salon') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-salon-text antialiased bg-salon-bg flex flex-col min-h-screen selection:bg-salon-gold selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Mobile Sidebar Drawer & Backdrop -->
    <div x-show="mobileMenuOpen" class="relative z-[100] lg:hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" style="display: none;">
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-salon-text bg-opacity-75 transition-opacity"
             @click="mobileMenuOpen = false"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <!-- Drawer -->
                <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-xs w-full pr-10">
                    <div x-show="mobileMenuOpen"
                         x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
                         x-transition:enter-start="-translate-x-full"
                         x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="-translate-x-full"
                         class="pointer-events-auto relative w-screen max-w-sm">

                        <div class="flex h-full flex-col overflow-y-scroll bg-salon-cream shadow-2xl py-6">
                            <div class="px-4 sm:px-6 flex items-center justify-between">
                                <a href="{{ route('home') }}" class="flex items-center gap-3">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                                    <span class="text-xl font-serif font-bold text-salon-gold tracking-tight">{{ $setting->salon_name ?? 'Eeva Salon' }}</span>
                                </a>
                                <button type="button" class="relative rounded-md text-salon-text hover:text-salon-gold focus:outline-none focus:ring-2 focus:ring-salon-gold p-2" @click="mobileMenuOpen = false">
                                    <span class="absolute -inset-2.5"></span>
                                    <span class="sr-only">Tutup menu</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="relative mt-8 flex-1 px-4 sm:px-6">
                                <nav class="flex flex-1 flex-col space-y-2">
                                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Beranda</a>
                                    <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Layanan</a>
                                    <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Produk</a>
                                    <a href="{{ route('promotions') }}" class="{{ request()->routeIs('promotions') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Promo</a>
                                    <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Galeri</a>
                                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-salon-beige text-salon-text' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} block rounded-lg px-3 py-3 text-base font-medium transition">Kontak</a>
                                </nav>

                                <div class="mt-8 pt-8 border-t border-salon-beige">
                                    @auth
                                        @role('admin')
                                            <a href="{{ route('admin.dashboard') }}" class="block w-full text-center rounded-lg bg-salon-gold px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-salon-goldHover transition">Dasboard Admin</a>
                                        @else
                                            <a href="{{ route('customer.dashboard') }}" class="block w-full text-center rounded-lg bg-salon-gold px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-salon-goldHover transition">Dasboard Saya</a>
                                        @endrole
                                    @else
                                        <div class="space-y-4">
                                            <a href="{{ route('login') }}" class="block w-full text-center rounded-lg bg-white px-4 py-3 text-base font-medium text-salon-text border border-salon-beige shadow-sm hover:bg-salon-bg transition">Masuk</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="block w-full text-center rounded-lg bg-salon-gold px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-salon-goldHover transition">Daftar</a>
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop & Mobile Header -->
    <nav class="bg-salon-cream shadow-sm sticky top-0 z-40 border-b border-salon-beige">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 sm:h-12 w-auto object-contain">
                        <span class="text-xl sm:text-2xl font-serif font-bold text-salon-gold tracking-tight">{{ $setting->salon_name ?? 'Eeva Salon' }}</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Beranda</a>
                    <a href="{{ route('services') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('services') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Layanan</a>
                    <a href="{{ route('products') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Produk</a>
                    <a href="{{ route('promotions') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('promotions') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Promo</a>
                    <a href="{{ route('gallery') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('gallery') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Galeri</a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact') ? 'border-salon-gold text-salon-text' : 'border-transparent text-salon-textLight hover:text-salon-gold hover:border-salon-beige' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Kontak</a>
                </div>

                <!-- Desktop Auth -->
                <div class="hidden lg:flex lg:items-center gap-4">
                    @auth
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-salon-gold hover:text-salon-goldHover transition">Dashboard Admin</a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="text-sm font-medium text-salon-gold hover:text-salon-goldHover transition">Dasboard Saya</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-salon-textLight hover:text-salon-gold transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-salon-gold hover:bg-salon-goldHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-salon-gold transition">Daftar</a>
                        @endif
                    @endauth
                </div>

                <!-- Hamburger Button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" @click="mobileMenuOpen = true" class="inline-flex items-center justify-center p-2 rounded-md text-salon-text hover:text-salon-gold hover:bg-salon-beige focus:outline-none focus:ring-2 focus:ring-inset focus:ring-salon-gold transition" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg class="block h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-salon-cream border-t border-salon-beige text-salon-textLight mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-salon-text text-lg font-serif font-bold mb-4">{{ $setting->salon_name ?? 'Eeva Salon' }}</h3>
                    <p class="text-sm leading-relaxed">{{ $setting->address ?? 'Jalan Kecantikan 123, Kota' }}</p>
                    <p class="text-sm mt-2">Telepon: {{ $setting->phone ?? '+62 812 3456 7890' }}</p>
                    <p class="text-sm">Email: {{ $setting->email ?? 'halo@eevasalon.com' }}</p>
                </div>
                <div>
                    <h3 class="text-salon-text text-lg font-serif font-bold mb-4">Jam Operasional</h3>
                    <p class="text-sm leading-relaxed">Senin - Minggu:<br>{{ \Carbon\Carbon::parse($setting->opening_hour ?? '09:00')->format('H:i') }} - {{ \Carbon\Carbon::parse($setting->closing_hour ?? '19:00')->format('H:i') }} WIB</p>
                </div>
                <div>
                    <h3 class="text-salon-text text-lg font-serif font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        @if(!empty($setting->instagram))
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-salon-textLight hover:text-salon-gold transition">Instagram</a>
                        @endif
                        @if(!empty($setting->facebook))
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-salon-textLight hover:text-salon-gold transition">Facebook</a>
                        @endif
                        @if(!empty($setting->tiktok))
                            <a href="{{ $setting->tiktok }}" target="_blank" class="text-salon-textLight hover:text-salon-gold transition">TikTok</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-salon-beige pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ $setting->salon_name ?? 'Eeva Salon' }}. Hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
