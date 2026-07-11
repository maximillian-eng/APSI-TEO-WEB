@extends('layouts.admin')

@section('title', 'Status Peminjaman Buku')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ $buku->judul }}</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">ISBN:</span> <span class="text-gray-800 dark:text-gray-200 font-mono">{{ $buku->isbn }}</span></div>
            <div><span class="text-gray-500">Pengarang:</span> <span class="text-gray-800 dark:text-gray-200">{{ $buku->pengarang->nama_pengarang }}</span></div>
            <div><span class="text-gray-500">Kategori:</span> <span class="text-gray-800 dark:text-gray-200">{{ $buku->kategori->nama_kategori }}</span></div>
            <div>
                <span class="text-gray-500">Stok:</span>
                <span class="font-medium {{ $buku->stok_tersedia > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $buku->stok_tersedia }}/{{ $buku->stok_total }}</span>
            </div>
            <div class="col-span-2">
                <span class="text-gray-500">Status:</span>
                @if($buku->stok_tersedia > 0)
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Tersedia</span>
                @else
                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Dipinjam</span>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-gray-800 dark:text-white">Peminjam Aktif</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Anggota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transaksiAktif as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $trx->anggota->nama }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_jatuh_tempo->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">Tidak ada yang sedang meminjam buku ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('admin.buku.index') }}" class="inline-block px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Kembali</a>
</div>
@endsection
