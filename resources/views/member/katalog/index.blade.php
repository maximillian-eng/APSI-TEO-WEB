@extends('layouts.member')

@section('title', 'Katalog Buku')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 sm:p-6 mb-6">
    <form method="GET" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, ISBN, atau pengarang..."
               class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
        <select name="kategori" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium">Cari</button>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
    @forelse($bukus as $buku)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
        <div class="p-5">
            <div class="flex items-start justify-between mb-2">
                <span class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 rounded-full">{{ $buku->kategori->nama_kategori }}</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $buku->isbn }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mt-2 line-clamp-2">{{ $buku->judul }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $buku->pengarang->nama_pengarang }}</p>
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm font-medium {{ $buku->stok_tersedia > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    Stok: {{ $buku->stok_tersedia }}/{{ $buku->stok_total }}
                </span>
                <a href="{{ route('member.katalog.show', $buku) }}" class="text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 text-sm font-medium">
                    Detail &rarr;
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
        <p class="text-gray-500 dark:text-gray-400">Tidak ada buku yang sesuai dengan pencarian Anda.</p>
    </div>
    @endforelse
</div>

<div class="mt-6">{{ $bukus->links() }}</div>
@endsection
