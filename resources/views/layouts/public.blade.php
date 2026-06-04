<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->salon_name ?? config('app.name', 'Eeva Salon') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 antialiased bg-stone-50 flex flex-col min-h-screen">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-rose-500 tracking-tighter">
                            {{ $setting->salon_name ?? 'Eeva Salon' }}
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Home</a>
                        <a href="{{ route('services') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('services') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Services</a>
                        <a href="{{ route('products') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Products</a>
                        <a href="{{ route('promotions') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('promotions') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Promotions</a>
                        <a href="{{ route('gallery') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('gallery') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Gallery</a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact') ? 'border-rose-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">Contact</a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 underline">Admin Dashboard</a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="text-sm text-gray-700 underline">My Dashboard</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-stone-900 text-stone-300 mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">{{ $setting->salon_name ?? 'Eeva Salon' }}</h3>
                    <p class="text-sm">{{ $setting->address ?? '123 Beauty Street, NY' }}</p>
                    <p class="text-sm mt-2">Phone: {{ $setting->phone ?? '+1 234 567 890' }}</p>
                    <p class="text-sm">Email: {{ $setting->email ?? 'hello@eevasalon.com' }}</p>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Opening Hours</h3>
                    <p class="text-sm">Mon - Sun: {{ \Carbon\Carbon::parse($setting->opening_hour ?? '09:00')->format('H:i') }} - {{ \Carbon\Carbon::parse($setting->closing_hour ?? '19:00')->format('H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        @if(!empty($setting->instagram))
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-stone-300 hover:text-white">Instagram</a>
                        @endif
                        @if(!empty($setting->facebook))
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-stone-300 hover:text-white">Facebook</a>
                        @endif
                        @if(!empty($setting->tiktok))
                            <a href="{{ $setting->tiktok }}" target="_blank" class="text-stone-300 hover:text-white">TikTok</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-stone-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ $setting->salon_name ?? 'Eeva Salon' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
