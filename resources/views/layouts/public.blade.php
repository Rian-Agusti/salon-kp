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
<body class="font-sans text-gray-800 antialiased bg-stone-50 flex flex-col min-h-screen selection:bg-rose-500 selection:text-white">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                        <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-rose-500 tracking-tight">
                            {{ $setting->salon_name ?? 'Eeva Salon' }}
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Beranda</a>
                        <a href="{{ route('services') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('services') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Layanan</a>
                        <a href="{{ route('products') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Produk</a>
                        <a href="{{ route('promotions') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('promotions') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Promo</a>
                        <a href="{{ route('gallery') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('gallery') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Galeri</a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact') ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:text-rose-500 hover:border-rose-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Kontak</a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                    @auth
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-rose-600 hover:text-rose-700 transition">Dasbor Admin</a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="text-sm font-medium text-rose-600 hover:text-rose-700 transition">Dasbor Saya</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-rose-600 transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition">Daftar</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 text-gray-600 mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-gray-900 text-lg font-serif font-bold mb-4">{{ $setting->salon_name ?? 'Eeva Salon' }}</h3>
                    <p class="text-sm">{{ $setting->address ?? 'Jalan Kecantikan 123, Kota' }}</p>
                    <p class="text-sm mt-2">Telepon: {{ $setting->phone ?? '+62 812 3456 7890' }}</p>
                    <p class="text-sm">Email: {{ $setting->email ?? 'halo@eevasalon.com' }}</p>
                </div>
                <div>
                    <h3 class="text-gray-900 text-lg font-serif font-bold mb-4">Jam Operasional</h3>
                    <p class="text-sm">Senin - Minggu: {{ \Carbon\Carbon::parse($setting->opening_hour ?? '09:00')->format('H:i') }} - {{ \Carbon\Carbon::parse($setting->closing_hour ?? '19:00')->format('H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-gray-900 text-lg font-serif font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        @if(!empty($setting->instagram))
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-gray-500 hover:text-rose-500 transition">Instagram</a>
                        @endif
                        @if(!empty($setting->facebook))
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-gray-500 hover:text-rose-500 transition">Facebook</a>
                        @endif
                        @if(!empty($setting->tiktok))
                            <a href="{{ $setting->tiktok }}" target="_blank" class="text-gray-500 hover:text-rose-500 transition">TikTok</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-100 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ $setting->salon_name ?? 'Eeva Salon' }}. Hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
