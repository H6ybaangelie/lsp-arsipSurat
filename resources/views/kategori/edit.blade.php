@extends('layouts.app')

@section('title', 'Kategori Surat >> Edit')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-2">Kategori Surat &gt;&gt; Edit</h2>
    <p class="text-gray-700 mb-6">
        Perbarui data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan".
    </p>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ID Auto Increment (readonly) -->
        <div class="mb-4">
            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
            <input type="text" id="id" name="id" value="{{ $kategori->id }}" readonly
                class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-gray-600 cursor-not-allowed" />
        </div>

        <!-- Nama Kategori -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
            @error('nama')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Keterangan -->
        <div class="mb-6">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('keterangan', $kategori->keterangan) }}</textarea>
            @error('keterangan')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-between">
            <a href="{{ route('kategori.index') }}"
                class="bg-gray-100 text-black px-4 py-2 rounded hover:bg-gray-200">Kembali</a>
            <button type="submit"
                class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
