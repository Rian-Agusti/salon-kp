@extends('layouts.admin')

@section('header')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Pelanggan</h2>
        <div class="flex w-full sm:w-auto gap-2">
            <form action="{{ route('admin.customers.index') }}" method="GET" class="flex-grow sm:flex-grow-0 flex items-center border border-gray-300 rounded-md overflow-hidden bg-white shadow-sm focus-within:ring-1 focus-within:ring-salon-gold focus-within:border-salon-gold">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, no. telp, atau email..." class="w-full border-none focus:ring-0 text-sm px-3 py-2">
                <button type="submit" class="px-3 py-2 bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900 border-l border-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
            <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 whitespace-nowrap">
                Tambah Walk-in
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Member</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statistik</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-salon-beige rounded-full flex items-center justify-center text-salon-gold font-bold text-lg">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-salon-text">
                                        {{ $customer->name }}
                                        @if(!$customer->is_active)
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-salon-text">{{ $customer->email }}</div>
                            <div class="text-sm text-gray-500">{{ $customer->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($customer->type == 'online')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Online</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Walk-in</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($customer->member_until && $customer->member_until->gte(today()))
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Member
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Bukan Member
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>Kunjungan: <strong>{{ $customer->reservations_count }}x</strong></div>
                            <div>Pengeluaran: <strong>Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</strong></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $customer->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.customers.show', $customer) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded">Detail</a>
                            <a href="{{ route('admin.customers.edit', $customer) }}" class="text-salon-gold hover:text-yellow-700 bg-yellow-50 px-3 py-1 rounded">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            Belum ada pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($customers->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $customers->links() }}
        </div>
    @endif
</div>
@endsection
