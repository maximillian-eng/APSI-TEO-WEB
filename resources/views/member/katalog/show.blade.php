@extends('layouts.member')

@section('title', 'Detail Buku')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-start justify-between mb-4">
            <span class="px-3 py-1 text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 rounded-full">{{ $buku->kategori->nama_kategori }}</span>
            @if($buku->stok_tersedia > 0)
                <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full">Tersedia</span>
            @else
                <span class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">Kosong</span>
            @endif
        </div>

        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $buku->judul }}</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">oleh {{ $buku->pengarang->nama_pengarang }}</p>

        <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
            <div><span class="text-gray-500">ISBN:</span> <span class="text-gray-800 dark:text-gray-200 font-mono">{{ $buku->isbn }}</span></div>
            <div><span class="text-gray-500">Stok:</span> <span class="text-gray-800 dark:text-gray-200 font-medium">{{ $buku->stok_tersedia }}/{{ $buku->stok_total }}</span></div>
        </div>

        @if($buku->pengarang->biografi)
        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Tentang Pengarang</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $buku->pengarang->biografi }}</p>
        </div>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('member.katalog.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Kembali</a>

        @if($buku->stok_tersedia > 0)
        <form method="POST" action="{{ route('member.peminjaman.store', $buku) }}"
              x-data
              x-on:submit.prevent="if(confirm('Yakin ingin meminjam buku ini?')) $el.submit()">
            @csrf
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium">
                Pinjam Buku
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
