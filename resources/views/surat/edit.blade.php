@extends('layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Surat</h2>

    <form action="{{ route('surat.update', $surat) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nomor Surat --}}
        <div>
            <label for="nomor_surat" class="block font-semibold">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat"
                   value="{{ old('nomor_surat', $surat->nomor_surat) }}"
                   class="w-full border rounded px-3 py-2 text-black @error('nomor_surat') border-red-500 @enderror" required>
            @error('nomor_surat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label for="kategori" class="block font-semibold">Kategori</label>
            <select id="kategori" name="kategori"
                    class="w-full border rounded px-3 py-2 text-black @error('kategori') border-red-500 @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->nama }}"
                        {{ old('kategori', $surat->kategori) == $kategori->nama ? 'selected' : '' }}>
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
            <input type="text" id="judul" name="judul"
                   value="{{ old('judul', $surat->judul) }}"
                   class="w-full border rounded px-3 py-2 text-black @error('judul') border-red-500 @enderror" required>
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- File Surat --}}
        <div>
            <label for="file_surat" class="block font-semibold">
                File Surat (PDF) <small class="text-gray-500">(kosongkan jika tidak ingin ganti)</small>
            </label>
            <input type="file" id="file_surat" name="file_surat" accept="application/pdf"
                   class="w-full border rounded px-3 py-2 text-black @error('file_surat') border-red-500 @enderror">
            @error('file_surat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between">
            <a href="{{ route('surat.show', $surat) }}" class="bg-gray-100 text-black px-4 py-2 rounded hover:bg-gray-200">Batal</a>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
