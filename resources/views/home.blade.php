@extends('layouts.public')

@section('content')
<div class="bg-rose-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block text-rose-500">Discover Your Beauty</span>
            <span class="block">at Eeva Salon</span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Experience premium hair and beauty treatments with our professional stylists. Book your appointment today and let us pamper you.
        </p>
        <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
            <div class="rounded-md shadow">
                <a href="{{ route('customer.reservations.create') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-rose-500 hover:bg-rose-600 md:py-4 md:text-lg md:px-10">
                    Book Now
                </a>
            </div>
            <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                <a href="{{ route('services') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-rose-500 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                    Our Services
                </a>
            </div>
        </div>
    </div>
</div>

@if($promotions->count() > 0)
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Special Promotions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($promotions as $promo)
                <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
                    @if($promo->image)
                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $promo->title }}</h3>
                        <p class="text-sm text-gray-500 mb-4">Valid until {{ \Carbon\Carbon::parse($promo->end_date)->format('M d, Y') }}</p>
                        <p class="text-gray-700">{{ Str::limit($promo->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="py-12 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Popular Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-stone-200 flex items-center justify-center text-stone-400">No Image</div>
                    @endif
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $service->name }}</h3>
                            <span class="text-rose-500 font-bold">${{ number_format($service->price, 2) }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">{{ $service->duration_minutes }} mins</p>
                        <p class="text-gray-700 text-sm">{{ Str::limit($service->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('services') }}" class="text-rose-500 font-medium hover:text-rose-600">View all services &rarr;</a>
        </div>
    </div>
</div>
@endsection
