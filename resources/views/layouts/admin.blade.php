<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Eeva Salon') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 antialiased bg-gray-100 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div class="w-64 bg-stone-900 text-white flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-stone-800">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-rose-500">Eeva Admin</a>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Dashboard
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Reservations
            </a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Services
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Products
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="{{ request()->routeIs('admin.promotions.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Promotions
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Gallery
            </a>
            <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Customers
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'bg-stone-800 text-white' : 'text-stone-300 hover:bg-stone-800 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
                Settings
            </a>
        </nav>
        <div class="p-4 border-t border-stone-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-stone-300 hover:text-white text-sm font-medium">
                    Logout ({{ Auth::user()->name }})
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow h-16 flex items-center justify-between px-6">
            <h2 class="font-semibold text-xl text-gray-800">
                @yield('header', 'Admin Panel')
            </h2>
            <a href="{{ route('home') }}" target="_blank" class="text-sm text-rose-500 hover:underline">View Site</a>
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
