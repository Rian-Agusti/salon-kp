@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Reservasi</h2>
    </div>
@endsection

@section('content')
    <a href="{{ route('admin.reservations.create') }}"
        class="inline-flex items-center px-4 py-2 mb-4 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Buat Transaksi Offline
    </a>
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                <span class="text-sm font-medium text-gray-700 block mb-2 sm:mb-0 w-24">Status:</span>
                <div class="flex flex-wrap gap-2">
                <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('status') == '' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Semua</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">Pending</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'confirmed']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('status') == 'confirmed' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">Confirmed</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'completed']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">Completed</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">Cancelled</a>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                <span class="text-sm font-medium text-gray-700 block mb-2 sm:mb-0 w-24">Sumber:</span>
                <div class="flex flex-wrap gap-2">
                <a href="{{ request()->fullUrlWithQuery(['source' => null]) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('source') == '' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Semua</a>
                <a href="{{ request()->fullUrlWithQuery(['source' => 'online']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('source') == 'online' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">Online</a>
                <a href="{{ request()->fullUrlWithQuery(['source' => 'offline']) }}"
                    class="px-3 py-1 text-sm rounded-full {{ request('source') == 'offline' ? 'bg-purple-500 text-white' : 'bg-purple-100 text-purple-800 hover:bg-purple-200' }}">Offline</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode / Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status / Sumber</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reservations as $reservation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-salon-gold">{{ $reservation->reservation_code }}</div>
                                    <div class="text-sm text-gray-500">{{ $reservation->booking_date->format('d M Y') }} at
                                        {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-salon-text">{{ $reservation->customer_name }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $reservation->customer_phone ?? $reservation->customer_email }}</div>
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
                                    <span
                                        class="badge {{ $statusColors[$reservation->status->value] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($reservation->status->value) }}
                                    </span>
                                    <div class="mt-1">
                                        @if($reservation->source == 'online')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-600">Online</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-50 text-purple-600">Offline</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}"
                                        class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada reservasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reservations->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reservations->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
@endsection
