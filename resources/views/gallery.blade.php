@extends('layouts.public')

@section('content')
<div class="bg-salon-bg py-16 sm:py-24" x-data="{ filter: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-salon-gold font-semibold tracking-wider uppercase text-sm">Portofolio</span>
            <h1 class="mt-2 text-4xl font-serif font-bold text-salon-text sm:text-5xl">Galeri Kami</h1>
            <p class="mt-4 max-w-2xl text-lg text-salon-textLight mx-auto">Lihatlah hasil karya terbaru dan suasana salon kami.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <button @click="filter = 'all'" :class="{ 'bg-salon-gold text-white border-transparent': filter === 'all', 'bg-white text-salon-textLight border-gray-200 hover:border-rose-300 hover:text-salon-gold': filter !== 'all' }" class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-sm text-xs sm:text-sm font-medium border transition duration-300 focus:outline-none">Semua</button>
            <button @click="filter = 'hair'" :class="{ 'bg-salon-gold text-white border-transparent': filter === 'hair', 'bg-white text-salon-textLight border-gray-200 hover:border-rose-300 hover:text-salon-gold': filter !== 'hair' }" class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-sm text-xs sm:text-sm font-medium border transition duration-300 focus:outline-none">Rambut</button>
            <button @click="filter = 'facial'" :class="{ 'bg-salon-gold text-white border-transparent': filter === 'facial', 'bg-white text-salon-textLight border-gray-200 hover:border-rose-300 hover:text-salon-gold': filter !== 'facial' }" class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-sm text-xs sm:text-sm font-medium border transition duration-300 focus:outline-none">Wajah</button>
            <button @click="filter = 'coloring'" :class="{ 'bg-salon-gold text-white border-transparent': filter === 'coloring', 'bg-white text-salon-textLight border-gray-200 hover:border-rose-300 hover:text-salon-gold': filter !== 'coloring' }" class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-sm text-xs sm:text-sm font-medium border transition duration-300 focus:outline-none">Pewarnaan</button>
            <button @click="filter = 'other'" :class="{ 'bg-salon-gold text-white border-transparent': filter === 'other', 'bg-white text-salon-textLight border-gray-200 hover:border-rose-300 hover:text-salon-gold': filter !== 'other' }" class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full shadow-sm text-xs sm:text-sm font-medium border transition duration-300 focus:outline-none">Lainnya</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galleries as $item)
                <div x-show="filter === 'all' || filter === '{{ $item->category }}'" class="group relative overflow-hidden rounded-2xl shadow-sm border border-salon-beige cursor-pointer" style="display: none;" x-transition>
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-72 object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                        <h3 class="text-white font-serif font-bold text-lg mb-2 translate-y-4 group-hover:translate-y-0 transition duration-300">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="text-gray-200 text-sm mb-3 line-clamp-2 translate-y-4 group-hover:translate-y-0 transition duration-300 delay-75">{{ $item->description }}</p>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-salon-gold text-white w-fit translate-y-4 group-hover:translate-y-0 transition duration-300 delay-100">
                            {{ $item->category == 'hair' ? 'Rambut' : ($item->category == 'facial' ? 'Wajah' : ($item->category == 'coloring' ? 'Pewarnaan' : 'Lainnya')) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-salon-beige shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="mt-4 text-gray-500 text-lg font-medium">Belum ada gambar di galeri saat ini.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($galleries, 'links'))
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
