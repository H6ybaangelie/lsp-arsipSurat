<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Tampilkan daftar kategori
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoris = Kategori::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%$search%");
        })->orderBy('id', 'asc')->get();

        return view('kategori.index', compact('kategoris', 'search'));
    }

    // Form tambah kategori
    public function create()
    {
        $lastId = Kategori::max('id'); // cari id terakhir
        return view('kategori.create', compact('lastId'));
    }


    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Form edit kategori
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
