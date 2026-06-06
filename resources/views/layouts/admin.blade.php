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
<body class="font-sans text-gray-800 antialiased bg-gray-50 flex h-screen overflow-hidden selection:bg-rose-500 selection:text-white">

    <!-- Sidebar -->
    <div class="w-64 bg-white text-gray-800 flex flex-col shadow-lg border-r border-gray-100 z-10">
        <div class="h-20 flex items-center justify-center border-b border-gray-100 gap-3 px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-serif font-bold text-rose-500 tracking-tight">Admin</a>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-3">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Dasbor
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Reservasi
            </a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Layanan
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Produk
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="{{ request()->routeIs('admin.promotions.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Promo
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Galeri
            </a>
            <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Pelanggan
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'bg-rose-50 text-rose-600' : 'text-gray-600 hover:bg-gray-50 hover:text-rose-500' }} group flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition">
                Pengaturan
            </a>
        </nav>
        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                    Keluar ({{ Auth::user()->name }})
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden bg-gray-50">
        <header class="bg-white shadow-sm border-b border-gray-100 h-20 flex items-center justify-between px-8 z-0">
            <h2 class="font-serif font-bold text-2xl text-gray-800">
                @yield('header', 'Panel Admin')
            </h2>
            <a href="{{ route('home') }}" target="_blank" class="text-sm font-medium text-rose-500 hover:text-rose-600 transition hover:underline">Lihat Situs</a>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
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
