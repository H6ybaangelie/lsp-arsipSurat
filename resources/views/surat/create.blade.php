@extends('layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-2">Arsip Surat &gt;&gt; Unggah</h2>
    <p class="text-gray-600 mb-1">Unggah surat yang telah terbit pada form ini untuk diarsipkan.</p>
    <small class="text-gray-500">Catatan: Gunakan file berformat PDF</small>
    <div class="border-b my-4"></div>

    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Nomor Surat --}}
        <div>
            <label for="nomor_surat" class="block font-semibold">Nomor Surat</label>
            <input type="text" name="nomor_surat" id="nomor_surat"
                   value="{{ old('nomor_surat') }}"
                   class="w-full border rounded px-3 py-2 @error('nomor_surat') border-red-500 @enderror" required>
            @error('nomor_surat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label for="kategori" class="block font-semibold">Kategori</label>
            <select name="kategori" id="kategori"
                    class="w-full border rounded px-3 py-2 @error('kategori') border-red-500 @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->nama }}" {{ old('kategori') == $kategori->nama ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Judul --}}
        <div>
            <label for="judul" class="block font-semibold">Judul</label>
            <input type="text" name="judul" id="judul"
                   value="{{ old('judul') }}"
                   class="w-full border rounded px-3 py-2 @error('judul') border-red-500 @enderror" required>
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- File Surat --}}
        <div>
            <label for="file_surat" class="block font-semibold">File Surat (PDF)</label>
            <input type="file" name="file_surat" id="file_surat"
                   accept="application/pdf"
                   class="w-full border rounded px-3 py-2 @error('file_surat') border-red-500 @enderror" required>
            @error('file_surat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('surat.index') }}" class="bg-gray-100 text-black px-4 py-2 rounded hover:bg-gray-200">Kembali</a>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
