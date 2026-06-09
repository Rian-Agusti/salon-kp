@extends('layouts.admin')

@section('header', 'Ringkasan Dasboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-salon-beige hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Pelanggan</p>
                    <p class="mt-2 text-3xl font-serif font-bold text-salon-text">{{ $totalCustomers }}</p>
                </div>
                <div class="p-4 bg-salon-cream rounded-xl border border-rose-100 text-salon-gold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-salon-beige hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Reservasi</p>
                    <p class="mt-2 text-3xl font-serif font-bold text-salon-text">{{ $totalReservations }}</p>
                </div>
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-salon-beige hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Menunggu</p>
                    <p class="mt-2 text-3xl font-serif font-bold text-salon-text">{{ $pendingReservations }}</p>
                </div>
                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-salon-beige hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Jadwal Hari Ini</p>
                    <p class="mt-2 text-3xl font-serif font-bold text-salon-text">{{ $todaysReservations }}</p>
                </div>
                <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-sm border border-salon-beige overflow-hidden">
            <div class="px-6 py-5 border-b border-salon-beige bg-gray-50/50">
                <h3 class="text-lg font-serif font-bold text-salon-text">Layanan Terpopuler</h3>
            </div>
            @if(count($popularServices) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama
                                    Layanan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total
                                    Pesanan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($popularServices as $stat)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-bold text-salon-text flex items-center gap-3">
                                        <span
                                            class="w-6 h-6 rounded-full bg-salon-cream text-salon-gold flex items-center justify-center text-xs border border-rose-100">{{ $loop->iteration }}</span>
                                        {{ $stat['service_name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right font-medium">
                                        <span class="bg-gray-100 px-3 py-1 rounded-lg text-gray-700">{{ $stat['count'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center text-gray-500">
                    <p class="font-medium">Belum ada data reservasi selesai untuk menentukan layanan terpopuler.</p>
                </div>
            @endif
        </div>
    </div>
@endsection