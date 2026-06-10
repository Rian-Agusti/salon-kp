@extends('layouts.admin')

@section('header', 'Profil Pelanggan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.customers.index') }}" class="text-salon-textLight hover:text-salon-text flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Pelanggan
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Customer Profile Box -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
            <div class="h-24 w-24 mx-auto bg-salon-beige rounded-full flex items-center justify-center text-salon-gold font-bold text-4xl mb-4 relative">
                {{ substr($customer->name, 0, 1) }}
                @if(!$customer->is_active)
                    <span class="absolute bottom-0 right-0 block h-4 w-4 rounded-full bg-red-400 ring-2 ring-white"></span>
                @else
                    <span class="absolute bottom-0 right-0 block h-4 w-4 rounded-full bg-green-400 ring-2 ring-white"></span>
                @endif
            </div>
            <h2 class="text-xl font-bold text-salon-text">{{ $customer->name }}</h2>
            <p class="text-sm text-gray-500 mb-4">
                @if($customer->type == 'online')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Online</span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Walk-in</span>
                @endif
            </p>

            <div class="mb-6">
                <a href="{{ route('admin.customers.edit', $customer) }}" class="inline-flex justify-center items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 focus:bg-opacity-90 active:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-salon-gold focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Profil
                </a>
            </div>

            <div class="text-left space-y-3 border-t border-salon-beige pt-4">
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Status Member</span>
                    @if($customer->member_until && $customer->member_until->gte(today()))
                        <span class="inline-flex mt-1 items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                            Member
                        </span>
                        <div class="text-xs text-gray-500 mt-1">Sampai: {{ $customer->member_until->format('d M Y') }}</div>
                    @else
                        <span class="inline-flex mt-1 items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                            Bukan Member
                        </span>
                    @endif
                </div>
                @if($customer->type == 'online')
                    <div>
                        <span class="text-xs text-gray-500 uppercase tracking-wider block">Email</span>
                        <a href="mailto:{{ $customer->email }}" class="text-sm font-medium text-blue-600 hover:underline">{{ $customer->email }}</a>
                    </div>
                @endif
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Telepon</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->phone ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Tanggal Lahir</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->birth_date ? $customer->birth_date->format('d M Y') : 'Belum diatur' }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Alamat</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->address ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Catatan</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->notes ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics & Reservation History -->
    <div class="lg:col-span-3 space-y-6">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="text-sm text-gray-500 uppercase tracking-wider">Total Kunjungan</div>
                <div class="text-2xl font-bold text-salon-text mt-1">{{ $totalVisits }}x</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="text-sm text-gray-500 uppercase tracking-wider">Total Pengeluaran</div>
                <div class="text-2xl font-bold text-salon-gold mt-1">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="text-sm text-gray-500 uppercase tracking-wider">Layanan Favorit</div>
                <div class="text-lg font-bold text-salon-text mt-1 truncate" title="{{ $favoriteService ?? '-' }}">{{ $favoriteService ?? '-' }}</div>
            </div>
        </div>

        <!-- Reservation Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-salon-text">Riwayat Reservasi</h3>
                <a href="{{ route('admin.reservations.create') }}" class="text-sm text-salon-gold hover:underline">Buat Reservasi Baru</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total & Diskon</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status & Sumber</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customer->reservations as $reservation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-salon-gold">
                                    {{ $reservation->reservation_code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-text">
                                    {{ $reservation->booking_date->format('d M Y') }}<br>
                                    <span class="text-gray-500">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-text">
                                    {{ $reservation->reservationItems->pluck('service_name')->implode(', ') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-text">
                                    Rp {{ number_format($reservation->reservationItems->sum('service_price') - $reservation->discount_amount, 0, ',', '.') }}
                                    @if($reservation->discount_amount > 0)
                                        <br><span class="text-green-600 text-xs">- Rp {{ number_format($reservation->discount_amount, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase {{ $statusColors[$reservation->status->value] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $reservation->status->value }}
                                    </span>
                                    <br>
                                    @if($reservation->source == 'online')
                                        <span class="px-2 mt-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-600">Online</span>
                                    @else
                                        <span class="px-2 mt-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-50 text-purple-600">Offline</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada riwayat reservasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
