<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Pengarang;
use App\Models\TransaksiPeminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBukuController extends Controller
{
    public function index(Request $request): View
    {
        $query = Buku::with(['kategori', 'pengarang']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('pengarang', fn ($q) => $q->where('nama_pengarang', 'like', "%{$search}%"))
                    ->orWhereHas('kategori', fn ($q) => $q->where('nama_kategori', 'like', "%{$search}%"));
            });
        }

        $bukus = $query->latest()->paginate(10)->withQueryString();

        return view('admin.buku.index', compact('bukus'));
    }

    public function create(): View
    {
        $kategoris = KategoriBuku::orderBy('nama_kategori')->get();
        $pengarangs = Pengarang::orderBy('nama_pengarang')->get();

        return view('admin.buku.create', compact('kategoris', 'pengarangs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_bukus,id',
            'id_pengarang' => 'required|exists:pengarangs,id',
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:bukus,isbn',
            'stok_total' => 'required|integer|min:1',
        ]);

        $validated['stok_tersedia'] = $validated['stok_total'];

        Buku::create($validated);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Buku $buku): View
    {
        $kategoris = KategoriBuku::orderBy('nama_kategori')->get();
        $pengarangs = Pengarang::orderBy('nama_pengarang')->get();

        return view('admin.buku.edit', compact('buku', 'kategoris', 'pengarangs'));
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_bukus,id',
            'id_pengarang' => 'required|exists:pengarangs,id',
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:bukus,isbn,'.$buku->id,
            'stok_total' => 'required|integer|min:1',
        ]);

        $selisih = $validated['stok_total'] - $buku->stok_total;
        $validated['stok_tersedia'] = max(0, $buku->stok_tersedia + $selisih);

        $buku->update($validated);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $adaDipinjam = TransaksiPeminjaman::where('id_buku', $buku->id)
            ->where('status_peminjaman', 'dipinjam')
            ->exists();

        if ($adaDipinjam) {
            return redirect()->route('admin.buku.index')
                ->with('error', 'Buku sedang dipinjam oleh anggota. Tidak dapat dihapus!');
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    public function status(Buku $buku): View
    {
        $buku->load(['kategori', 'pengarang']);
        $transaksiAktif = TransaksiPeminjaman::with('anggota')
            ->where('id_buku', $buku->id)
            ->where('status_peminjaman', 'dipinjam')
            ->get();

        return view('admin.buku.status', compact('buku', 'transaksiAktif'));
    }
}
