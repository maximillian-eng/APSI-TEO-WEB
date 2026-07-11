@extends('layouts.admin')

@section('title', 'Kelola Pengarang')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h2 class="font-semibold text-gray-800 dark:text-white">Daftar Pengarang</h2>
        <a href="{{ route('admin.pengarang.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">+ Tambah</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Biografi</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah Buku</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($pengarangs as $pengarang)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium">{{ $pengarang->nama_pengarang }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400 text-xs">{{ Str::limit($pengarang->biografi, 60) }}</td>
                    <td class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">{{ $pengarang->bukus_count }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.pengarang.edit', $pengarang) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 text-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.pengarang.destroy', $pengarang) }}" class="inline" x-data
                              x-on:submit.prevent="if(confirm('Yakin hapus pengarang ini?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pengarang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $pengarangs->links() }}</div>
</div>
@endsection
