@extends('layouts.public')

@section('content')
<div class="bg-white relative overflow-hidden">
    <!-- Dekorasi background -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-rose-50 opacity-50 z-0"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-rose-50 opacity-50 z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-32 text-center lg:pt-32 lg:pb-40">
        <h1 class="text-4xl font-serif font-bold text-gray-900 sm:text-5xl md:text-6xl leading-tight tracking-tight">
            <span class="block">Pancarkan Pesona</span>
            <span class="block text-rose-500 mt-2 italic">Kecantikan Naturalmu</span>
        </h1>
        <p class="mt-6 max-w-xl mx-auto text-base text-gray-600 sm:text-lg md:mt-8 md:text-xl md:max-w-3xl leading-relaxed">
            Nikmati layanan perawatan rambut dan kecantikan premium dengan penata rambut profesional kami. Pesan jadwalmu sekarang dan rasakan perbedaannya.
        </p>
        <div class="mt-8 max-w-md mx-auto sm:flex sm:justify-center md:mt-10 gap-4">
            <div class="rounded-lg shadow-sm">
                <a href="{{ route('customer.reservations.create') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-rose-500 hover:bg-rose-600 hover:shadow-md transition duration-300 md:py-4 md:text-lg md:px-10">
                    Pesan Sekarang
                </a>
            </div>
            <div class="mt-3 rounded-lg shadow-sm sm:mt-0">
                <a href="{{ route('services') }}" class="w-full flex items-center justify-center px-8 py-3 border border-rose-200 text-base font-medium rounded-lg text-rose-600 bg-rose-50 hover:bg-rose-100 transition duration-300 md:py-4 md:text-lg md:px-10">
                    Layanan Kami
                </a>
            </div>
        </div>
    </div>
</div>

@if($promotions->count() > 0)
<div class="py-16 bg-stone-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-rose-500 font-semibold tracking-wider uppercase text-sm">Penawaran Spesial</span>
            <h2 class="mt-2 text-3xl font-serif font-bold text-gray-900 sm:text-4xl">Promo Menarik</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($promotions as $promo)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition duration-300 rounded-2xl border border-gray-100 group">
                    @if($promo->image)
                        <div class="overflow-hidden h-52">
                            <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="w-full h-52 bg-rose-50 flex items-center justify-center text-rose-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">{{ $promo->title }}</h3>
                        <p class="text-xs font-medium text-rose-500 mb-4 bg-rose-50 inline-block px-3 py-1 rounded-full">Berlaku s/d {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d F Y') }}</p>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($promo->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-rose-500 font-semibold tracking-wider uppercase text-sm">Layanan Kami</span>
            <h2 class="mt-2 text-3xl font-serif font-bold text-gray-900 sm:text-4xl">Layanan Terpopuler</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition duration-300 rounded-2xl border border-gray-100 group flex flex-col">
                    @if($service->image)
                        <div class="overflow-hidden h-56">
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="w-full h-56 bg-rose-50 flex items-center justify-center text-rose-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2 gap-4">
                            <h3 class="text-xl font-serif font-bold text-gray-900">{{ $service->name }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm flex-1 leading-relaxed mt-2">{{ Str::limit($service->description, 100) }}</p>
                        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-rose-600 font-bold text-lg">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            <span class="text-sm font-medium text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $service->duration_minutes }} mnt
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 transition duration-300">
                Lihat Semua Layanan
            </a>
        </div>
    </div>
</div>
@endsection
