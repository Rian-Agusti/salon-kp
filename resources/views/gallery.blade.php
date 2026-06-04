@extends('layouts.public')

@section('content')
<div class="py-12 bg-stone-50" x-data="{ filter: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900">Our Gallery</h1>
            <p class="mt-4 text-xl text-gray-500">Explore our portfolio of beautiful transformations.</p>
        </div>

        <div class="flex justify-center space-x-2 sm:space-x-4 mb-10 flex-wrap">
            <button @click="filter = 'all'" :class="{ 'bg-rose-500 text-white': filter === 'all', 'bg-white text-gray-700 hover:bg-gray-50': filter !== 'all' }" class="px-4 py-2 rounded-full text-sm font-medium shadow-sm mb-2 transition-colors">All</button>
            <button @click="filter = 'hair'" :class="{ 'bg-rose-500 text-white': filter === 'hair', 'bg-white text-gray-700 hover:bg-gray-50': filter !== 'hair' }" class="px-4 py-2 rounded-full text-sm font-medium shadow-sm mb-2 transition-colors">Hair</button>
            <button @click="filter = 'facial'" :class="{ 'bg-rose-500 text-white': filter === 'facial', 'bg-white text-gray-700 hover:bg-gray-50': filter !== 'facial' }" class="px-4 py-2 rounded-full text-sm font-medium shadow-sm mb-2 transition-colors">Facial</button>
            <button @click="filter = 'coloring'" :class="{ 'bg-rose-500 text-white': filter === 'coloring', 'bg-white text-gray-700 hover:bg-gray-50': filter !== 'coloring' }" class="px-4 py-2 rounded-full text-sm font-medium shadow-sm mb-2 transition-colors">Coloring</button>
            <button @click="filter = 'other'" :class="{ 'bg-rose-500 text-white': filter === 'other', 'bg-white text-gray-700 hover:bg-gray-50': filter !== 'other' }" class="px-4 py-2 rounded-full text-sm font-medium shadow-sm mb-2 transition-colors">Other</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($galleries as $item)
                <div x-show="filter === 'all' || filter === '{{ $item->category }}'" class="group relative overflow-hidden rounded-lg shadow-sm" style="display: none;" x-transition>
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-rose-300 text-xs font-semibold uppercase tracking-wider mb-1">{{ $item->category }}</span>
                        <h3 class="text-white text-lg font-bold">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="text-gray-300 text-sm mt-2 line-clamp-2">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No gallery images available at the moment.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
