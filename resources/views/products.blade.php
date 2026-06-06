@extends('layouts.public')

@section('content')
<div class="bg-salon-bg py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-salon-gold font-semibold tracking-wider uppercase text-sm">Etalase Kami</span>
            <h1 class="mt-2 text-4xl font-serif font-bold text-salon-text sm:text-5xl">Produk Kecantikan</h1>
            <p class="mt-4 max-w-2xl text-lg text-salon-textLight mx-auto">Produk perawatan rambut dan kecantikan premium untuk rutinitas perawatan di rumah Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition duration-300 rounded-2xl border border-salon-beige flex flex-col group">
                    @if($product->image)
                        <div class="overflow-hidden h-64">
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    @else
                        <div class="w-full h-64 bg-salon-cream flex items-center justify-center text-rose-300">
                             <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-lg font-serif font-bold text-salon-text mb-2">{{ $product->name }}</h3>
                        <p class="text-salon-textLight text-sm flex-grow leading-relaxed">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-4 pt-4 border-t border-salon-beige flex flex-col gap-2">
                            <span class="text-salon-goldHover font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-salon-beige shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <p class="mt-4 text-gray-500 text-lg font-medium">Belum ada produk yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($products, 'links'))
        <div class="mt-12">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
