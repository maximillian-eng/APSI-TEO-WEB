<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengembalianBuku;
use App\Models\TransaksiPeminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $query = TransaksiPeminjaman::with(['anggota', 'buku', 'admin']);

        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('anggota', fn ($q) => $q->where('nama', 'like', "%{$search}%"))
                    ->orWhereHas('buku', fn ($q) => $q->where('judul', 'like', "%{$search}%"));
            });
        }

        $transaksis = $query->latest()->paginate(10)->withQueryString();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function show(TransaksiPeminjaman $transaksi): View
    {
        $transaksi->load(['anggota', 'buku', 'admin', 'pengembalian']);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function pengembalianForm(TransaksiPeminjaman $transaksi): View
    {
        $transaksi->load(['anggota', 'buku']);

        $hariTelat = max(0, now()->diffInDays($transaksi->tanggal_jatuh_tempo, false));
        $dendaKeterlambatan = $hariTelat * 1000;

        return view('admin.transaksi.pengembalian', compact('transaksi', 'hariTelat', 'dendaKeterlambatan'));
    }

    public function prosesPengembalian(Request $request, TransaksiPeminjaman $transaksi): RedirectResponse
    {
        $validated = $request->validate([
            'kondisi_buku' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
            'denda_kerusakan' => 'required|numeric|min:0',
        ]);

        $hariTelat = max(0, now()->diffInDays($transaksi->tanggal_jatuh_tempo, false));
        $dendaKeterlambatan = $hariTelat * 1000;
        $dendaKerusakan = match ($validated['kondisi_buku']) {
            'Bagus' => 0,
            'Rusak Ringan' => 25000,
            'Rusak Berat' => 50000,
            default => (float) $validated['denda_kerusakan'],
        };
        $totalDenda = $dendaKeterlambatan + $dendaKerusakan;

        PengembalianBuku::create([
            'id_transaksi' => $transaksi->id,
            'id_admin' => auth()->id(),
            'tanggal_pengembalian' => now()->toDateString(),
            'kondisi_buku' => $validated['kondisi_buku'],
            'denda_keterlambatan' => $dendaKeterlambatan,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $totalDenda,
        ]);

        $status = $hariTelat > 0 ? 'terlambat' : 'dikembalikan';
        $transaksi->update(['status_peminjaman' => $status]);

        $transaksi->buku->increment('stok_tersedia');

        $msg = 'Buku berhasil dikembalikan.';
        if ($totalDenda > 0) {
            $msg .= ' Total denda: Rp '.number_format($totalDenda, 0, ',', '.');
        }

        return redirect()->route('admin.transaksi.index')->with('success', $msg);
    }
}
