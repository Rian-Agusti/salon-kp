@extends('layouts.admin')

@section('header', 'Add New Gallery Item')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category" id="category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">
                    <option value="hair" {{ old('category') == 'hair' ? 'selected' : '' }}>Hair</option>
                    <option value="facial" {{ old('category') == 'facial' ? 'selected' : '' }}>Facial</option>
                    <option value="coloring" {{ old('category') == 'coloring' ? 'selected' : '' }}>Coloring</option>
                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image (Required, Max 2MB, jpg/png/webp) *</label>
                <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" required
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-salon-cream file:text-salon-goldHover hover:file:bg-salon-beige border border-gray-300 rounded-md">
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('admin.galleries.index') }}" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded shadow-sm hover:bg-gray-50 mr-3">Cancel</a>
            <button type="submit" class="bg-salon-gold hover:bg-salon-goldHover text-white font-medium py-2 px-4 rounded shadow-sm">Save Image</button>
        </div>
    </form>
</div>
@endsection
