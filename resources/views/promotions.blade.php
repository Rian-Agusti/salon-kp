@extends('layouts.public')

@section('content')
<div class="bg-stone-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-rose-500 font-semibold tracking-wider uppercase text-sm">Penawaran Spesial</span>
            <h1 class="mt-2 text-4xl font-serif font-bold text-gray-900 sm:text-5xl">Promo Menarik</h1>
            <p class="mt-4 max-w-2xl text-lg text-gray-600 mx-auto">Manfaatkan penawaran dan paket spesial kami yang sedang berlangsung.</p>
        </div>

        <div class="space-y-12">
            @forelse($promotions as $promotion)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition duration-300 rounded-2xl border border-gray-100 flex flex-col md:flex-row group">
                    @if($promotion->image)
                        <div class="md:w-1/3 overflow-hidden">
                            <img src="{{ Storage::url($promotion->image) }}" alt="{{ $promotion->title }}" class="h-64 w-full object-cover md:h-full group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="md:w-1/3 h-64 md:h-auto bg-rose-50 flex items-center justify-center text-rose-300">
                             <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        </div>
                    @endif
                    <div class="p-8 {{ $promotion->image ? 'md:w-2/3' : 'w-full' }} flex flex-col justify-center">
                        <div class="inline-flex items-center w-fit text-sm font-medium text-rose-500 bg-rose-50 px-3 py-1 rounded-full mb-3">
                            Berlaku s/d {{ \Carbon\Carbon::parse($promotion->end_date)->translatedFormat('d F Y') }}
                        </div>
                        <h3 class="mt-1 text-2xl font-serif font-bold text-gray-900">{{ $promotion->title }}</h3>
                        <p class="mt-4 text-gray-600 leading-relaxed">{{ $promotion->description }}</p>
                        @if($promotion->discount_amount)
                            <div class="mt-4">
                                <span class="inline-flex items-center gap-2 text-rose-600 font-bold text-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Diskon Rp {{ number_format($promotion->discount_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        @endif
                        <div class="mt-8">
                            <a href="{{ route('customer.reservations.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-rose-500 hover:bg-rose-600 transition duration-300">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    <p class="mt-4 text-gray-500 text-lg font-medium">Belum ada promo aktif saat ini.</p>
                    <p class="mt-2 text-gray-500">Silakan periksa kembali nanti untuk penawaran menarik lainnya!</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($promotions, 'links'))
        <div class="mt-12">
            {{ $promotions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
