@extends('layouts.admin')

@section('title', 'Edit Anggota')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.anggota.update', $anggota) }}">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $anggota->email) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $anggota->no_telepon) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('no_telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="status_anggota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status_anggota" id="status_anggota" required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="Aktif" {{ old('status_anggota', $anggota->status_anggota) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non-aktif" {{ old('status_anggota', $anggota->status_anggota) === 'Non-aktif' ? 'selected' : '' }}>Non-aktif</option>
                    </select>
                    @error('status_anggota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-6 space-x-3">
                <a href="{{ route('admin.anggota.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
