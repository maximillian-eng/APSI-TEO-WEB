@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h2 class="font-semibold text-gray-800 dark:text-white">Daftar Kategori</h2>
        <a href="{{ route('admin.kategori.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm font-medium">+ Tambah</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Deskripsi</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah Buku</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($kategoris as $kategori)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium">{{ $kategori->nama_kategori }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400 text-xs">{{ Str::limit($kategori->deskripsi, 50) }}</td>
                    <td class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">{{ $kategori->bukus_count }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-purple-600 hover:text-purple-800 dark:text-purple-400 text-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.kategori.destroy', $kategori) }}" class="inline" x-data
                              x-on:submit.prevent="if(confirm('Yakin hapus kategori ini?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $kategoris->links() }}</div>
</div>
@endsection
