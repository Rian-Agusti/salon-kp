<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eeva Salon') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased selection:bg-rose-500 selection:text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-stone-50">
        <div>
            <a href="/" class="flex flex-col items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24 object-contain">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white shadow-lg border border-gray-100 overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>