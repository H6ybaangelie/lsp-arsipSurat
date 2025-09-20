@extends('layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Arsip Surat &gt;&gt; Lihat</h2>
    <p class="mb-4 text-gray-600">Detail arsip surat yang tersimpan dalam sistem.</p>

    {{-- Tabel Detail Surat --}}
    <div class="overflow-x-auto mb-4">
        <table class="min-w-full border border-gray-300">
            <tbody class="divide-y divide-gray-200">
                <tr class="bg-gray-50">
                    <th class="text-left px-4 py-2 w-48">Nomor Surat</th>
                    <td class="px-4 py-2">{{ $surat->nomor_surat }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Judul</th>
                    <td class="px-4 py-2">{{ $surat->judul }}</td>
                </tr>
                <tr class="bg-gray-50">
                    <th class="text-left px-4 py-2">Kategori</th>
                    <td class="px-4 py-2">{{ $surat->kategori }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Waktu Unggah</th>
                    <td class="px-4 py-2">{{ $surat->waktu_pengarsipan }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Preview PDF --}}
    <div class="border w-full mb-4">
        @if($surat->file_path && file_exists(storage_path('app/public/' . $surat->file_path)))
            <iframe src="{{ asset('storage/' . $surat->file_path) }}" 
                    class="w-full h-80 md:h-96" frameborder="0"></iframe>
        @else
            <p class="text-gray-500 text-center py-20">Belum ada file diunggah.</p>
        @endif
    </div>

    {{-- Tombol aksi --}}
    <div class="flex flex-wrap gap-2 justify-start">
        <a href="{{ route('surat.index') }}" 
           class="bg-gray-100 text-black px-4 py-2 rounded hover:bg-gray-200">
           Kembali
        </a>

        @if($surat->file_path && file_exists(storage_path('app/public/' . $surat->file_path)))
            <a href="{{ route('surat.download', $surat) }}" 
               class="px-4 py-2 bg-yellow-700 text-white rounded hover:bg-yellow-800">
                Unduh
            </a>
        @endif

        <a href="{{ route('surat.edit', $surat) }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Edit / Ganti File
        </a>
    </div>
</div>
@endsection
