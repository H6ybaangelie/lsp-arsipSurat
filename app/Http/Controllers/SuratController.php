<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Tampilkan daftar surat dengan pencarian
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $surats = Surat::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('nomor_surat', 'like', "%$search%");
        })
        ->latest() // default urut terbaru
        ->get();

        return view('surat.index', compact('surats', 'search'));
    }

    /**
     * Form tambah surat
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('surat.create', compact('kategoris'));
    }

    /**
     * Simpan surat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surats,nomor_surat',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:2048',
        ], [
            'nomor_surat.unique' => 'Nomor surat sudah ada, silakan gunakan nomor lain.',
        ]);

        // Simpan file ke disk public
        $path = $request->file('file_surat')->store('surat', 'public');

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'waktu_pengarsipan' => now(),
            'file_path' => $path,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diarsipkan!');
    }

    /**
     * Lihat detail surat
     */
    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    /**
     * Download file surat
     */
    public function download(Surat $surat)
    {
        $file = storage_path('app/public/' . $surat->file_path);

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File surat tidak ditemukan!');
        }

        return response()->download($file);
    }

    /**
     * Form edit surat
     */
    public function edit(Surat $surat)
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('surat.edit', compact('surat', 'kategoris'));
    }

    /**
     * Update surat
     */
    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surats,nomor_surat,' . $surat->id,
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ], [
            'nomor_surat.unique' => 'Nomor surat sudah ada, silakan gunakan nomor lain.',
        ]);

        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
        ]);

        if ($request->hasFile('file_surat')) {
            // Hapus file lama
            if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
                Storage::disk('public')->delete($surat->file_path);
            }

            $surat->file_path = $request->file('file_surat')->store('surat', 'public');
            $surat->save();
        }

        return redirect()->route('surat.show', $surat)->with('success', 'Surat berhasil diperbarui!');
    }

    /**
     * Hapus surat
     */
    public function destroy(Surat $surat)
    {
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus!');
    }
}
