@extends('layouts.app')

@section('content')
<div class="">
    <div class="w-full bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Arsip Surat</h2>
        <p class="text-gray-600 mb-4">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>

        <!-- Form pencarian -->
        <form method="GET" action="{{ route('surat.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" placeholder="Cari surat..." value="{{ $search ?? '' }}"
                   class="border px-3 py-2 rounded-l w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-black text-white px-4 rounded-r hover:bg-gray-800">Cari</button>
            <a href="{{ route('surat.index') }}" class="ml-2 bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
                Tampilkan Semua
            </a>
        </form>

        <!-- Tabel surat -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border text-left w-28">Nomor Surat</th>
                        <th class="p-2 border text-left">Kategori</th>
                        <th class="p-2 border text-left">Judul</th>
                        <th class="p-2 border text-left w-36">Waktu Pengarsipan</th>
                        <th class="p-2 border text-left w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($surats as $surat)
                    <tr>
                        <td class="p-2 border">{{ $surat->nomor_surat }}</td>
                        <td class="p-2 border">{{ $surat->kategori }}</td>
                        <td class="p-2 border">{{ $surat->judul }}</td>
                        <td class="p-2 border">{{ $surat->waktu_pengarsipan }}</td>
                        <td class="p-2 border flex gap-2">
                            <form class="delete-form" action="{{ route('surat.destroy', $surat) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete bg-red-800 text-white px-2 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                            @if($surat->file_path)
                            <a href="{{ route('surat.download', $surat) }}" 
                               class="bg-yellow-800 text-white px-2 py-1 rounded hover:bg-yellow-700">
                                Unduh
                            </a>
                            @endif
                            <a href="{{ route('surat.show', $surat) }}" 
                               class="bg-blue-800 text-white px-2 py-1 rounded hover:bg-blue-700">
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="p-2 border text-center" colspan="5">Belum ada surat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tombol tambah / arsipkan surat -->
        <a href="{{ route('surat.create') }}" 
           class="mt-4 inline-block bg-gray-800 text-white px-4 py-2 rounded">
           Arsipan Surat
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const form = button.closest('.delete-form');

            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus surat ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'bg-gray-900 text-white',
                    confirmButton: 'bg-red-700 hover:bg-red-600 text-white px-4 py-2 rounded',
                    cancelButton: 'bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
