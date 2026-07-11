@extends('layouts.admin')

@section('title', 'Tambah Pengarang')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.pengarang.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="nama_pengarang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengarang</label>
                    <input type="text" name="nama_pengarang" id="nama_pengarang" value="{{ old('nama_pengarang') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nama_pengarang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="biografi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biografi</label>
                    <textarea name="biografi" id="biografi" rows="4" required
                              class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('biografi') }}</textarea>
                    @error('biografi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex items-center justify-end mt-6 space-x-3">
                <a href="{{ route('admin.pengarang.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
