<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminKategoriController extends Controller
{
    public function index(): View
    {
        $kategoris = KategoriBuku::withCount('bukus')->latest()->paginate(10);

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create(): View
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
        ]);

        KategoriBuku::create($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(KategoriBuku $kategori): View
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriBuku $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(KategoriBuku $kategori): RedirectResponse
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
