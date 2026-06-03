<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eeva Hair & Beauty Salon') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-rose-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-rose-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-rose-600">
                            Eeva Salon
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-rose-600 hover:border-rose-300 focus:outline-none focus:text-rose-700 focus:border-rose-300 transition duration-150 ease-in-out">
                            Home
                        </a>
                        <a href="{{ url('/packages') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-rose-600 hover:border-rose-300 focus:outline-none focus:text-rose-700 focus:border-rose-300 transition duration-150 ease-in-out">
                            Packages/Services
                        </a>
                        <a href="{{ url('/pricelist') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-rose-600 hover:border-rose-300 focus:outline-none focus:text-rose-700 focus:border-rose-300 transition duration-150 ease-in-out">
                            Pricelist
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-rose-600 font-medium">User Dashboard</a>
                    @else
                        <a href="{{ url('/login') }}" class="text-sm text-gray-700 hover:text-rose-600 font-medium">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="ml-4 text-sm text-gray-700 hover:text-rose-600 font-medium">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-rose-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
            <div class="mb-4 md:mb-0">
                <p class="font-semibold text-rose-800">Eeva Hair & Beauty Salon Pondok Aren</p>
                <p>Jl. Raya Pondok Aren No.74, South Tangerang</p>
            </div>
            <div class="mb-4 md:mb-0 text-center">
                <p>Opening Hours: 09.00 - 19.00 WIB</p>
                <p>Phone: 0812-1111-6051</p>
            </div>
            <div class="text-right">
                <p>Instagram: <a href="https://instagram.com/eevasalon" class="text-rose-600 hover:text-rose-800">@eevasalon</a></p>
                <p class="mt-2 text-xs text-gray-400">&copy; {{ date('Y') }} Eeva Salon. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>