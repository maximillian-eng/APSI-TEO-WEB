@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-2 flex-1">
            <form method="GET" class="flex flex-1 gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari anggota atau buku..."
                       class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm">
                <select name="status" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                    <option value="">Semua Status</option>
                    <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Filter</button>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Anggota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Buku</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pinjam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jatuh Tempo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($transaksis as $trx)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $trx->anggota->nama }}</td>
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $trx->buku->judul }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_pinjam->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_jatuh_tempo->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($trx->status_peminjaman === 'dipinjam')
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full">Dipinjam</span>
                        @elseif($trx->status_peminjaman === 'dikembalikan')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full">Dikembalikan</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">Terlambat</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        @if($trx->status_peminjaman === 'dipinjam')
                            <a href="{{ route('admin.transaksi.pengembalian', $trx) }}" class="text-purple-600 hover:text-purple-800 text-xs font-medium">Proses Pengembalian</a>
                        @endif
                        <a href="{{ route('admin.transaksi.show', $trx) }}" class="text-gray-600 hover:text-gray-800 text-xs">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $transaksis->links() }}</div>
</div>
@endsection
