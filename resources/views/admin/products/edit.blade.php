@extends('layouts.admin')

@section('header', 'Edit Product: ' . $product->name)

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rp) *</label>
                <input type="number" name="price" id="price" value="{{ old('price', (int)$product->price) }}" min="0" step="1" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">
                @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Update Image (Max 2MB, jpg/png/webp)</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($product->image) }}" alt="Current Image" class="h-20 w-20 object-cover rounded border">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-salon-cream file:text-salon-goldHover hover:file:bg-salon-beige">
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige focus:ring-opacity-50">{{ old('description', $product->description) }}</textarea>
            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-salon-goldHover shadow-sm focus:border-salon-beige focus:ring focus:ring-offset-0 focus:ring-salon-beige focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-700">Active (Visible to customers)</span>
            </label>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-200">
            <a href="{{ route('admin.products.index') }}" class="bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded shadow-sm hover:bg-gray-50 mr-3">Cancel</a>
            <button type="submit" class="bg-salon-gold hover:bg-salon-goldHover text-white font-medium py-2 px-4 rounded shadow-sm">Update Product</button>
        </div>
    </form>
</div>
@endsection
