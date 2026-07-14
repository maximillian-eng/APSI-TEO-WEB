<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\PengembalianBuku;
use App\Models\TransaksiPeminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberRiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $user = auth()->user();

        $query = TransaksiPeminjaman::with(['buku', 'pengembalian'])
            ->where('id_anggota', $user->id);

        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        $riwayat = $query->latest('tanggal_pinjam')->paginate(10)->withQueryString();

        return view('member.riwayat.index', compact('riwayat'));
    }

    public function pengembalianForm(TransaksiPeminjaman $transaksi): View
    {
        $transaksi->load('buku');

        $hariTelat = max(0, $transaksi->tanggal_jatuh_tempo->diffInDays(now(), false));
        $dendaKeterlambatan = $hariTelat * 1000;

        return view('member.riwayat.pengembalian', compact('transaksi', 'hariTelat', 'dendaKeterlambatan'));
    }

    public function prosesPengembalian(Request $request, TransaksiPeminjaman $transaksi): RedirectResponse
    {
        $validated = $request->validate([
            'kondisi_buku' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
        ]);

        $hariTelat = max(0, $transaksi->tanggal_jatuh_tempo->diffInDays(now(), false));
        $dendaKeterlambatan = $hariTelat * 1000;
        $dendaKerusakan = match ($validated['kondisi_buku']) {
            'Bagus' => 0,
            'Rusak Ringan' => 25000,
            'Rusak Berat' => 50000,
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

        $msg = 'Buku berhasil dikembalikan. Terima kasih!';
        if ($totalDenda > 0) {
            $msg .= ' Total denda: Rp '.number_format($totalDenda, 0, ',', '.').'. Denda akan diproses oleh admin.';
        }

        return redirect()->route('member.riwayat')->with('success', $msg);
    }
}
