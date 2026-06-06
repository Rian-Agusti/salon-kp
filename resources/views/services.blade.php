@extends('layouts.public')

@section('content')
<div class="bg-salon-bg py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-salon-gold font-semibold tracking-wider uppercase text-sm">Katalog Kami</span>
            <h1 class="mt-2 text-4xl font-serif font-bold text-salon-text sm:text-5xl">Layanan Perawatan</h1>
            <p class="mt-4 max-w-2xl text-lg text-salon-textLight mx-auto">Temukan berbagai layanan perawatan rambut dan kecantikan premium yang dirancang khusus untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition duration-300 rounded-2xl border border-salon-beige flex flex-col group">
                    @if($service->image)
                        <div class="overflow-hidden h-56">
                            <img class="h-full w-full object-cover group-hover:scale-105 transition duration-500" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                        </div>
                    @else
                        <div class="h-56 w-full bg-salon-cream flex items-center justify-center text-rose-300">
                             <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start gap-4 mb-4">
                            <div>
                                <h3 class="text-xl font-serif font-bold text-salon-text">{{ $service->name }}</h3>
                                <p class="text-sm font-medium text-gray-500 flex items-center gap-1 mt-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $service->duration_minutes }} menit
                                </p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-salon-cream text-salon-goldHover border border-rose-100">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <p class="text-sm text-salon-textLight flex-1 leading-relaxed mb-6">{{ $service->description }}</p>
                        <a href="{{ route('customer.reservations.create', ['service_id' => $service->id]) }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-salon-gold hover:bg-salon-goldHover transition duration-300 {{ !$service->is_available ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                            {{ $service->is_available ? 'Pesan Layanan Ini' : 'Tidak Tersedia' }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white rounded-2xl border border-salon-beige shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <p class="mt-4 text-gray-500 text-lg font-medium">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($services, 'links'))
        <div class="mt-12">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
