@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pelanggan Walk-in</h2>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6">
        <form method="POST" action="{{ route('admin.customers.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Nama <span class="text-red-500">*</span></label>
                    <input id="name" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    @error('name')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block font-medium text-sm text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                    <input id="phone" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" type="text" name="phone" value="{{ old('phone') }}" required />
                    @error('phone')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Birth Date -->
                <div>
                    <label for="birth_date" class="block font-medium text-sm text-gray-700">Tanggal Lahir</label>
                    <input id="birth_date" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" type="date" name="birth_date" value="{{ old('birth_date') }}" />
                    @error('birth_date')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Member Until -->
                <div>
                    <label for="member_until" class="block font-medium text-sm text-gray-700">Masa Berlaku Member (Kosongkan jika bukan member)</label>
                    <input id="member_until" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" type="date" name="member_until" value="{{ old('member_until') }}" />
                    <p class="mt-1 text-xs text-gray-500">Isi tanggal untuk mengaktifkan member secara manual.</p>
                    @error('member_until')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label for="address" class="block font-medium text-sm text-gray-700">Alamat</label>
                    <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label for="notes" class="block font-medium text-sm text-gray-700">Catatan Internal</label>
                    <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Simpan Pelanggan Walk-in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
