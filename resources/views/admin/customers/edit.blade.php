@extends('layouts.admin')

@section('header', 'Edit Pelanggan: ' . $customer->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.customers.index') }}" class="text-salon-textLight hover:text-salon-text flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Pelanggan
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 lg:w-2/3 xl:w-1/2">
    <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-salon-text">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-salon-text">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50" required>
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-salon-text">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-salon-text">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">
            </div>

            <!-- Birth Date -->
            <div>
                <label for="birth_date" class="block text-sm font-medium text-salon-text">Tanggal Lahir</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $customer->birth_date ? $customer->birth_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">
                @error('birth_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Member Until -->
            <div>
                <label for="member_until" class="block text-sm font-medium text-salon-text">Masa Berlaku Member (Kosongkan jika bukan member)</label>
                <input type="date" name="member_until" id="member_until" value="{{ old('member_until', $customer->member_until ? $customer->member_until->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">
                @error('member_until')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Isi tanggal untuk mengaktifkan member secara manual, atau kosongkan untuk mencabut status member.</p>
            </div>

            <!-- Tipe Customer -->
            <div>
                <label for="type" class="block text-sm font-medium text-salon-text">Tipe Pelanggan</label>
                <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50" required>
                    <option value="online" {{ old('type', $customer->type) == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ old('type', $customer->type) == 'offline' ? 'selected' : '' }}>Walk-in</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center">
                <input id="is_active" type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-salon-gold shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50" {{ old('is_active', $customer->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Akun Aktif
                </label>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-salon-text">Alamat</label>
                <textarea id="address" name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">{{ old('address', $customer->address) }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-salon-text">Catatan Internal</label>
                <textarea id="notes" name="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-gold focus:ring-opacity-50">{{ old('notes', $customer->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
            <a href="{{ route('admin.customers.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 min-h-[48px] sm:min-h-0 text-center">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 focus:bg-opacity-90 active:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-salon-gold focus:ring-offset-2 transition ease-in-out duration-150 min-h-[48px] sm:min-h-0">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
