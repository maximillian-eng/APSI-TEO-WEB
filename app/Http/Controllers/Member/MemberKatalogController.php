<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberKatalogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Buku::with(['kategori', 'pengarang'])
            ->where('stok_tersedia', '>', 0);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('pengarang', fn ($q) => $q->where('nama_pengarang', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $bukus = $query->latest()->paginate(12)->withQueryString();
        $kategoris = KategoriBuku::orderBy('nama_kategori')->get();

        return view('member.katalog.index', compact('bukus', 'kategoris'));
    }

    public function show(Buku $buku): View
    {
        $buku->load(['kategori', 'pengarang']);

        return view('member.katalog.show', compact('buku'));
    }
}
