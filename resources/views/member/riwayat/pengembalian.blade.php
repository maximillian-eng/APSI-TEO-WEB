@extends('layouts.member')

@section('title', 'Kembalikan Buku')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Konfirmasi Pengembalian</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm mb-6">
            <div><span class="text-gray-500">Buku:</span> <span class="text-gray-800 dark:text-gray-200 font-medium">{{ $transaksi->buku->judul }}</span></div>
            <div><span class="text-gray-500">Tgl Pinjam:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</span></div>
            <div><span class="text-gray-500">Jatuh Tempo:</span> <span class="text-gray-800 dark:text-gray-200">{{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</span></div>
            @if($hariTelat > 0)
            <div class="sm:col-span-2 p-3 bg-red-50 dark:bg-red-900/30 rounded-lg">
                <p class="text-red-700 dark:text-red-300 font-medium">Buku terlambat {{ $hariTelat }} hari.</p>
                <p class="text-red-600 dark:text-red-400 text-sm">Denda keterlambatan: Rp {{ number_format($dendaKeterlambatan, 0, ',', '.') }}</p>
            </div>
            @else
            <div class="sm:col-span-2 p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                <p class="text-green-700 dark:text-green-300 font-medium">Pengembalian tepat waktu!</p>
            </div>
            @endif
        </div>

        <form method="POST" action="{{ route('member.pengembalian.store', $transaksi) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kondisi Buku</label>
                    <div class="space-y-2">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ old('kondisi_buku', 'Bagus') === 'Bagus' ? 'border-green-500 bg-green-50 dark:bg-green-900/20' : 'border-gray-300 dark:border-gray-600' }}">
                            <input type="radio" name="kondisi_buku" value="Bagus" {{ old('kondisi_buku', 'Bagus') === 'Bagus' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                            <span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Bagus (Tidak ada denda)</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ old('kondisi_buku') === 'Rusak Ringan' ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20' : 'border-gray-300 dark:border-gray-600' }}">
                            <input type="radio" name="kondisi_buku" value="Rusak Ringan" {{ old('kondisi_buku') === 'Rusak Ringan' ? 'checked' : '' }} class="text-yellow-600 focus:ring-yellow-500">
                            <span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Rusak Ringan (Denda: Rp 25.000)</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ old('kondisi_buku') === 'Rusak Berat' ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600' }}">
                            <input type="radio" name="kondisi_buku" value="Rusak Berat" {{ old('kondisi_buku') === 'Rusak Berat' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                            <span class="ml-3 text-sm text-gray-800 dark:text-gray-200">Rusak Berat (Denda: Rp 50.000)</span>
                        </label>
                    </div>
                    @error('kondisi_buku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-6 space-x-3">
                <a href="{{ route('member.riwayat') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Konfirmasi Pengembalian</button>
            </div>
        </form>
    </div>
</div>
@endsection
