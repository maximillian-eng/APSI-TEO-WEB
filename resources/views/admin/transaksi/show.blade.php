@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Transaksi #{{ $transaksi->id }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Anggota:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->anggota->nama }}</span></div>
            <div><span class="text-gray-500">Buku:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->buku->judul }}</span></div>
            <div><span class="text-gray-500">Tgl Pinjam:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</span></div>
            <div><span class="text-gray-500">Jatuh Tempo:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</span></div>
            <div><span class="text-gray-500">Admin:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->admin->nama }}</span></div>
            <div>
                <span class="text-gray-500">Status:</span>
                @if($transaksi->status_peminjaman === 'dipinjam')
                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Dipinjam</span>
                @elseif($transaksi->status_peminjaman === 'dikembalikan')
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Dikembalikan</span>
                @else
                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Terlambat</span>
                @endif
            </div>
        </div>
    </div>

    @if($transaksi->pengembalian)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-800 dark:text-white mb-4">Data Pengembalian</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Tgl Pengembalian:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->pengembalian->tanggal_pengembalian->format('d M Y') }}</span></div>
            <div><span class="text-gray-500">Kondisi:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->pengembalian->kondisi_buku }}</span></div>
            <div><span class="text-gray-500">Denda Keterlambatan:</span> <span class="text-gray-800 dark:text-gray-200">Rp {{ number_format($transaksi->pengembalian->denda_keterlambatan, 0, ',', '.') }}</span></div>
            <div><span class="text-gray-500">Denda Kerusakan:</span> <span class="text-gray-800 dark:text-gray-200">Rp {{ number_format($transaksi->pengembalian->denda_kerusakan, 0, ',', '.') }}</span></div>
            <div class="sm:col-span-2"><span class="text-gray-500 font-semibold">Total Denda:</span> <span class="text-red-600 dark:text-red-400 font-semibold">Rp {{ number_format($transaksi->pengembalian->total_denda, 0, ',', '.') }}</span></div>
        </div>
    </div>
    @endif

    <a href="{{ route('admin.transaksi.index') }}" class="inline-block px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Kembali</a>
</div>
@endsection
