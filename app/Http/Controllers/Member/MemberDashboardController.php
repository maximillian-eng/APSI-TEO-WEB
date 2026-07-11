<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\TransaksiPeminjaman;
use Illuminate\View\View;

class MemberDashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();
        $totalDipinjam = TransaksiPeminjaman::where('id_anggota', $user->id)
            ->where('status_peminjaman', 'dipinjam')
            ->count();
        $totalDikembalikan = TransaksiPeminjaman::where('id_anggota', $user->id)
            ->where('status_peminjaman', '!=', 'dipinjam')
            ->count();
        $totalBuku = Buku::where('stok_tersedia', '>', 0)->count();
        $peminjamanTerakhir = TransaksiPeminjaman::with(['buku'])
            ->where('id_anggota', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('member.dashboard', compact(
            'totalDipinjam', 'totalDikembalikan', 'totalBuku', 'peminjamanTerakhir'
        ));
    }
}
