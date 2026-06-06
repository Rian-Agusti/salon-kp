@extends('layouts.admin')

@section('header', 'Manajemen Layanan')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <h3 class="text-xl font-serif font-bold text-gray-900">Daftar Layanan</h3>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 bg-rose-500 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-rose-600 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Layanan Baru
    </a>
</div>

<div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Layanan</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Durasi</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($service->image)
                                        <img class="h-12 w-12 rounded-xl object-cover border border-gray-100" src="{{ Storage::url($service->image) }}" alt="">
                                    @else
                                        <div class="h-12 w-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $service->name }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($service->description, 30) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-rose-500">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $service->duration_minutes }} menit
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($service->is_active)
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200">Aktif</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-bold">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            <p class="mt-4 font-medium">Belum ada layanan yang ditambahkan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($services->hasPages())
        <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
