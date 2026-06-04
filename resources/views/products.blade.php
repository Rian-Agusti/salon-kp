@extends('layouts.public')

@section('content')
<div class="py-12 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900">Our Products</h1>
            <p class="mt-4 text-xl text-gray-500">Premium hair and beauty products for your home care routine.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 rounded-lg border border-gray-100 flex flex-col">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-stone-200 flex items-center justify-center text-stone-400">
                            No Image
                        </div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm flex-grow mb-4">{{ Str::limit($product->description, 80) }}</p>
                        <div class="text-rose-500 font-bold text-xl">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No products available at the moment.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
