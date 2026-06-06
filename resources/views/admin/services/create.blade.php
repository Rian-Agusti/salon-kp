@extends('layouts.admin')

@section('header', 'Tambah Layanan Baru')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-salon-beige overflow-hidden">
    <div class="px-6 py-5 border-b border-salon-beige bg-salon-bg/50">
        <h3 class="text-lg font-serif font-bold text-salon-text">Formulir Tambah Layanan</h3>
    </div>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="name" class="block text-sm font-bold text-salon-text mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border-salon-beige shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50 transition">
                @error('name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-bold text-salon-text mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" value="{{ old('price', 0) }}" min="0" step="1" required
                       class="w-full rounded-lg border-salon-beige shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50 transition">
                @error('price') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="duration_minutes" class="block text-sm font-bold text-salon-text mb-2">Durasi (menit) <span class="text-red-500">*</span></label>
                <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', 60) }}" min="1" required
                       class="w-full rounded-lg border-salon-beige shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50 transition">
                @error('duration_minutes') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-bold text-salon-text mb-2">Gambar (Maks 2MB, jpg/png/webp)</label>
                <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-salon-textLight file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-salon-cream file:text-salon-goldHover hover:file:bg-salon-beige transition cursor-pointer border border-salon-beige rounded-lg">
                @error('image') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-8">
            <label for="description" class="block text-sm font-bold text-salon-text mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded-lg border-salon-beige shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50 transition">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
        </div>

        <div class="mb-8 bg-salon-bg p-4 rounded-xl border border-salon-beige flex items-center">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-gray-300 text-salon-gold shadow-sm focus:border-salon-beige focus:ring focus:ring-offset-0 focus:ring-salon-beige focus:ring-opacity-50 transition">
                <span class="ml-3 text-sm font-bold text-salon-text">Aktif (Tersedia untuk dipesan pelanggan)</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-salon-beige">
            <a href="{{ route('admin.services.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center py-2.5 px-6 border border-gray-300 rounded-lg shadow-sm text-sm font-bold text-salon-text bg-white hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center py-2.5 px-8 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-salon-gold hover:bg-salon-goldHover transition">Simpan Layanan</button>
        </div>
    </form>
</div>
@endsection
