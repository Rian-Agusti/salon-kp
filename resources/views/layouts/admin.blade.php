<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Eeva Salon') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-salon-text antialiased bg-salon-bg flex h-screen overflow-hidden selection:bg-salon-gold selection:text-white" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-salon-text bg-opacity-75 z-40 lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-salon-cream text-salon-text flex flex-col shadow-2xl lg:shadow-lg border-r border-salon-beige lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:inset-auto">
        <div class="h-20 flex items-center justify-between lg:justify-center border-b border-salon-beige px-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-serif font-bold text-salon-gold tracking-tight">Admin</a>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden text-salon-textLight hover:text-salon-gold">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-3 custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Dasbor
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Reservasi
            </a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Layanan
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Produk
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="{{ request()->routeIs('admin.promotions.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Promo
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Galeri
            </a>
            <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Pelanggan
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'bg-salon-gold text-white shadow-sm' : 'text-salon-textLight hover:bg-salon-bg hover:text-salon-text' }} group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition">
                Pengaturan
            </a>
        </nav>
        <div class="p-4 border-t border-salon-beige">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-salon-gold text-white flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-salon-text truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-salon-textLight">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex justify-center items-center px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 bg-white border border-red-100 hover:bg-red-50 hover:border-red-200 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden bg-salon-bg">
        <header class="bg-white shadow-sm border-b border-salon-beige h-20 flex items-center justify-between px-4 sm:px-8 z-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-salon-text hover:text-salon-gold focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h2 class="font-serif font-bold text-xl sm:text-2xl text-salon-text">
                    @yield('header', 'Panel Admin')
                </h2>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex text-sm font-medium text-salon-textLight hover:text-salon-gold transition items-center gap-1 bg-salon-bg px-3 py-1.5 rounded-lg border border-salon-beige">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Lihat Situs
            </a>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-salon-bg p-4 sm:p-6 lg:p-8 custom-scrollbar">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
