@extends('layouts.member')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <form method="GET" class="flex gap-2">
            <select name="status" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                <option value="">Semua Status</option>
                <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Filter</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Buku</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pinjam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jatuh Tempo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($riwayat as $trx)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium">{{ $trx->buku->judul }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_pinjam->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $trx->tanggal_jatuh_tempo->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($trx->status_peminjaman === 'dipinjam')
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Dipinjam</span>
                        @elseif($trx->status_peminjaman === 'dikembalikan')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Selesai</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Terlambat</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($trx->status_peminjaman === 'dipinjam')
                            <a href="{{ route('member.pengembalian.form', $trx) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-medium">Kembalikan</a>
                        @elseif($trx->pengembalian)
                            <span class="text-gray-500 text-xs">Denda: Rp {{ number_format($trx->pengembalian->total_denda, 0, ',', '.') }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada riwayat peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $riwayat->links() }}</div>
</div>
@endsection
