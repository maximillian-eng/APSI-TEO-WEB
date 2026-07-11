<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\TransaksiPeminjaman;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalBuku = Buku::sum('stok_total');
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalDipinjam = TransaksiPeminjaman::where('status_peminjaman', 'dipinjam')->count();
        $transaksiTerakhir = TransaksiPeminjaman::with(['anggota', 'buku'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBuku', 'totalAnggota', 'totalDipinjam', 'transaksiTerakhir'
        ));
    }
}
