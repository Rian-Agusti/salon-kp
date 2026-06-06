@extends('layouts.admin')

@section('header', 'Gallery Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div></div>
    <a href="{{ route('admin.galleries.create') }}" class="bg-salon-gold hover:bg-salon-goldHover text-white font-medium py-2 px-4 rounded shadow-sm inline-flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Gallery Item
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($galleries as $gallery)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-16 w-24">
                                <img class="h-16 w-24 rounded object-cover" src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-text font-medium">
                            {{ $gallery->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-stone-100 text-stone-800 uppercase">
                                {{ $gallery->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this gallery item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No gallery items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($galleries->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection
