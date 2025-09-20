@extends('layouts.app')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Kategori Surat</h2>
    <p class="text-gray-600 mb-4">Kelola kategori surat yang tersedia di sistem.</p>

    <!-- Form pencarian -->
    <form method="GET" action="{{ route('kategori.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Cari kategori..." value="{{ $search ?? '' }}"
               class="border px-3 py-2 rounded-l w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-black text-white px-4 rounded-r hover:bg-gray-800">Cari</button>
        <a href="{{ route('kategori.index') }}" class="ml-2 bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
            Tampilkan Semua
        </a>
    </form>

    <!-- Tabel kategori -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border text-left w-20">ID</th>
                    <th class="p-2 border text-left">Nama Kategori</th>
                    <th class="p-2 border text-left">Keterangan</th>
                    <th class="p-2 border text-left w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kategoris as $kategori)
                <tr>
                    <td class="p-2 border">{{ $kategori->id }}</td>
                    <td class="p-2 border">{{ $kategori->nama }}</td>
                    <td class="p-2 border">{{ $kategori->keterangan }}</td>
                    <td class="p-2 border flex gap-2">
                        <form class="delete-form" action="{{ route('kategori.destroy', $kategori) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete bg-red-800 text-white px-2 py-1 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('kategori.edit', $kategori) }}" 
                        class="bg-blue-800 text-white px-2 py-1 rounded hover:bg-blue-700">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="p-2 border text-center" colspan="4">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol tambah kategori -->
    <a href="{{ route('kategori.create') }}" 
       class="mt-4 inline-block bg-gray-800 text-white px-4 py-2 rounded">
       Tambah Kategori Baru
    </a>
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
                title: 'Apakah anda yakin ingin menghapus kategori ini?',
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