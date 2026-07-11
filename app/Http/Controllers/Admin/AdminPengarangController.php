<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengarang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPengarangController extends Controller
{
    public function index(): View
    {
        $pengarangs = Pengarang::withCount('bukus')->latest()->paginate(10);

        return view('admin.pengarang.index', compact('pengarangs'));
    }

    public function create(): View
    {
        return view('admin.pengarang.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_pengarang' => 'required|string|max:150',
            'biografi' => 'required|string|max:2000',
        ]);

        Pengarang::create($validated);

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Pengarang berhasil ditambahkan!');
    }

    public function edit(Pengarang $pengarang): View
    {
        return view('admin.pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, Pengarang $pengarang): RedirectResponse
    {
        $validated = $request->validate([
            'nama_pengarang' => 'required|string|max:150',
            'biografi' => 'required|string|max:2000',
        ]);

        $pengarang->update($validated);

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Pengarang berhasil diperbarui!');
    }

    public function destroy(Pengarang $pengarang): RedirectResponse
    {
        $pengarang->delete();

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Pengarang berhasil dihapus!');
    }
}
