<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\TransaksiPeminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MemberPeminjamanController extends Controller
{
    public function create(Buku $buku): View
    {
        $buku->load(['kategori', 'pengarang']);

        return view('member.peminjaman.create', compact('buku'));
    }

    public function store(Buku $buku): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->isActive()) {
            return redirect()->back()->with('error', 'Akun Anda non-aktif. Hubungi admin.');
        }

        if (! $buku->isAvailable()) {
            return redirect()->back()->with('error', 'Maaf, stok buku habis. Silakan pilih buku lain.');
        }

        $adaDipinjam = TransaksiPeminjaman::where('id_anggota', $user->id)
            ->where('id_buku', $buku->id)
            ->where('status_peminjaman', 'dipinjam')
            ->exists();

        if ($adaDipinjam) {
            return redirect()->back()->with('error', 'Anda sedang meminjam buku ini.');
        }

        TransaksiPeminjaman::create([
            'id_anggota' => $user->id,
            'id_buku' => $buku->id,
            'id_admin' => 1,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
            'status_peminjaman' => 'dipinjam',
        ]);

        $buku->decrement('stok_tersedia');

        $jatuhTempo = now()->addDays(7)->translatedFormat('d M Y');

        return redirect()->route('member.riwayat')
            ->with('success', "Peminjaman berhasil! Buku harus dikembalikan sebelum {$jatuhTempo}.");
    }
}
