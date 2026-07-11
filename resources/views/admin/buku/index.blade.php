@extends('layouts.admin')

@section('title', 'Kelola Buku')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <form method="GET" class="flex-1 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, ISBN, pengarang..."
                   class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            <button type="submit" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Cari</button>
        </form>
        <a href="{{ route('admin.buku.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium text-center">
            + Tambah Buku
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ISBN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pengarang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Stok</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($bukus as $buku)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium">{{ $buku->judul }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-mono text-xs">{{ $buku->isbn }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $buku->pengarang->nama_pengarang }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $buku->kategori->nama_kategori }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-medium {{ $buku->stok_tersedia > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $buku->stok_tersedia }}/{{ $buku->stok_total }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.buku.status', $buku) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 text-xs">Status</a>
                        <a href="{{ route('admin.buku.edit', $buku) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 text-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.buku.destroy', $buku) }}" class="inline" x-data
                              x-on:submit.prevent="if(confirm('Apakah Anda yakin ingin menghapus buku ini?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada buku tersedia. Klik "Tambah Buku" untuk menambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">
        {{ $bukus->links() }}
    </div>
</div>
@endsection
