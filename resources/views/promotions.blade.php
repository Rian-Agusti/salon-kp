@extends('layouts.public')

@section('content')
<div class="py-12 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900">Current Promotions</h1>
            <p class="mt-4 text-xl text-gray-500">Take advantage of our special offers and seasonal packages.</p>
        </div>

        <div class="space-y-12">
            @forelse($promotions as $promotion)
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 md:flex">
                    @if($promotion->image)
                        <div class="md:w-1/3">
                            <img src="{{ Storage::url($promotion->image) }}" alt="{{ $promotion->title }}" class="h-64 w-full object-cover md:h-full">
                        </div>
                    @endif
                    <div class="p-8 {{ $promotion->image ? 'md:w-2/3' : 'w-full' }} flex flex-col justify-center">
                        <div class="uppercase tracking-wide text-sm text-rose-500 font-semibold mb-1">
                            Valid until {{ \Carbon\Carbon::parse($promotion->end_date)->format('F d, Y') }}
                        </div>
                        <h3 class="mt-1 text-2xl font-bold text-gray-900">{{ $promotion->title }}</h3>
                        <p class="mt-4 text-gray-600 leading-relaxed">{{ $promotion->description }}</p>
                        <div class="mt-6">
                            <a href="{{ route('customer.reservations.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500 bg-white rounded-lg shadow-sm">
                    <p class="text-lg">No active promotions at the moment.</p>
                    <p class="mt-2">Please check back later for exciting new offers!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
