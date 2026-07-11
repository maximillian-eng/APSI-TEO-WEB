@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.buku.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Buku</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('isbn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                        <select name="id_kategori" id="id_kategori" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="id_pengarang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengarang</label>
                        <select name="id_pengarang" id="id_pengarang" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Pengarang --</option>
                            @foreach($pengarangs as $pengarang)
                                <option value="{{ $pengarang->id }}" {{ old('id_pengarang') == $pengarang->id ? 'selected' : '' }}>{{ $pengarang->nama_pengarang }}</option>
                            @endforeach
                        </select>
                        @error('id_pengarang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="stok_total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                    <input type="number" name="stok_total" id="stok_total" value="{{ old('stok_total', 1) }}" min="1" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('stok_total') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-6 space-x-3">
                <a href="{{ route('admin.buku.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
