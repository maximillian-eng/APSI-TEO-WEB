<?php

use App\Http\Controllers\Admin\AdminAnggotaController;
use App\Http\Controllers\Admin\AdminBukuController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPengarangController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\MemberKatalogController;
use App\Http\Controllers\Member\MemberPeminjamanController;
use App\Http\Controllers\Member\MemberRiwayatController;
use Illuminate\Support\Facades\Route;

Route::get('/up', fn () => response()->json(['status' => 'ok']));

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('member.dashboard');
    }

    return redirect()->route('login');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    Route::resource('buku', AdminBukuController::class)->except(['show']);
    Route::get('buku/{buku}/status', [AdminBukuController::class, 'status'])->name('buku.status');

    Route::resource('anggota', AdminAnggotaController::class)->except(['show']);

    Route::get('transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [AdminTransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('transaksi/{transaksi}/pengembalian', [AdminTransaksiController::class, 'pengembalianForm'])->name('transaksi.pengembalian');
    Route::post('transaksi/{transaksi}/proses-pengembalian', [AdminTransaksiController::class, 'prosesPengembalian'])->name('transaksi.proses-pengembalian');

    Route::resource('kategori', AdminKategoriController::class)->except(['show']);
    Route::resource('pengarang', AdminPengarangController::class)->except(['show']);
});

// Member Routes
Route::middleware(['auth', 'role:anggota'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', MemberDashboardController::class)->name('dashboard');

    Route::get('katalog', [MemberKatalogController::class, 'index'])->name('katalog.index');
    Route::get('katalog/{buku}', [MemberKatalogController::class, 'show'])->name('katalog.show');

    Route::get('peminjaman/{buku}/pinjam', [MemberPeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman/{buku}/simpan', [MemberPeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('riwayat', [MemberRiwayatController::class, 'index'])->name('riwayat');
    Route::get('riwayat/{transaksi}/kembalikan', [MemberRiwayatController::class, 'pengembalianForm'])->name('pengembalian.form');
    Route::post('riwayat/{transaksi}/proses-kembalikan', [MemberRiwayatController::class, 'prosesPengembalian'])->name('pengembalian.store');
});

require __DIR__.'/auth.php';
