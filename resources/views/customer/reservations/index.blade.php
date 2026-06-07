@extends('layouts.customer')

@section('header', 'Reservasi Saya')

@section('content')
    <div class="mb-12">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
            <h3 class="text-2xl font-serif font-bold text-salon-text">Reservasi Aktif</h3>
            <a href="{{ route('customer.reservations.create') }}"
                class="inline-flex justify-center items-center px-4 py-2.5 sm:py-2 bg-salon-gold border border-transparent rounded-lg font-medium text-sm text-white shadow-sm hover:bg-salon-goldHover focus:outline-none focus:ring-2 focus:ring-salon-gold focus:ring-offset-2 transition ease-in-out duration-300 w-full sm:w-auto">
                Buat Reservasi
            </a>
        </div>

        @if($activeReservations->count() > 0)
            <div class="bg-white shadow-sm border border-salon-beige rounded-2xl overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    @foreach($activeReservations as $reservation)
                        <li class="hover:bg-gray-50/50 transition">
                            <a href="{{ route('customer.reservations.show', $reservation) }}" class="block">
                                <div class="px-6 py-6 sm:px-8">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-bold text-salon-gold truncate">
                                            {{ $reservation->reservation_code }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-3 py-1 inline-flex text-xs font-bold rounded-full {{ $reservation->status->value === 'confirmed' ? 'bg-blue-50 text-blue-600 border border-blue-200' : 'bg-amber-50 text-amber-600 border border-amber-200' }}">
                                                {{ $reservation->status->value === 'confirmed' ? 'Dikonfirmasi' : 'Menunggu' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:flex sm:justify-between">
                                        <div class="sm:flex gap-6">
                                            <p class="flex items-center text-sm text-salon-textLight">
                                                <svg class="flex-shrink-0 mr-2 h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ $reservation->booking_date->translatedFormat('d F Y') }}
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-salon-textLight sm:mt-0">
                                                <svg class="flex-shrink-0 mr-2 h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <p>Dibuat {{ $reservation->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-white border border-salon-beige rounded-2xl p-12 text-center shadow-sm">
                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="mt-4 text-gray-500 font-medium">Anda belum memiliki reservasi aktif saat ini.</p>
            </div>
        @endif
    </div>

    <div>
        <h3 class="text-2xl font-serif font-bold text-salon-text mb-6">Riwayat Selesai</h3>
        @if($completedReservations->count() > 0)
            <div class="bg-white shadow-sm border border-salon-beige rounded-2xl overflow-hidden opacity-80 hover:opacity-100 transition duration-300">
                <ul class="divide-y divide-gray-100">
                    @foreach($completedReservations as $reservation)
                        <li class="hover:bg-gray-50/50 transition">
                            <a href="{{ route('customer.reservations.show', $reservation) }}" class="block">
                                <div class="px-6 py-5 sm:px-8">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-bold text-salon-textLight truncate">
                                            {{ $reservation->reservation_code }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-3 py-1 inline-flex text-xs font-bold rounded-full {{ $reservation->status->value === 'completed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-red-50 text-red-600 border border-red-200' }}">
                                                {{ $reservation->status->value === 'completed' ? 'Selesai' : 'Dibatalkan' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                                {{ $reservation->booking_date->translatedFormat('d F Y') }} pukul
                                                {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-white border border-salon-beige rounded-2xl p-10 text-center shadow-sm">
                <p class="text-gray-500 font-medium">Belum ada riwayat reservasi yang selesai.</p>
            </div>
        @endif
    </div>
@endsection