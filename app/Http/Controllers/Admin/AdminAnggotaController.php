<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminAnggotaController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::where('role', 'anggota');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $anggotas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.anggota.index', compact('anggotas'));
    }

    public function create(): View
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telepon' => 'nullable|string|max:20',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
            'status_anggota' => 'Aktif',
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil didaftarkan!');
    }

    public function edit(User $anggota): View
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, User $anggota): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.$anggota->id,
            'no_telepon' => 'nullable|string|max:20',
            'status_anggota' => 'required|in:Aktif,Non-aktif',
        ]);

        $anggota->update($validated);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(User $anggota): RedirectResponse
    {
        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
