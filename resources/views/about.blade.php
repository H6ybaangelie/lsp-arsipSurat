{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="w-full bg-white p-6 rounded shadow">
    <h2 class="text-3xl font-bold mb-8 text-center">Tentang Aplikasi</h2>

    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10">
        <!-- Foto Profil Panjang -->
        <div class="w-40 h-55 rounded-lg overflow-hidden shadow-md mb-6 md:mb-0">
            <img src="{{ asset('images/profile.jpg') }}" 
                 alt="Foto Profil" 
                 class="w-full h-full object-cover">
        </div>

        <!-- Info Developer -->
        <div class="flex-1 w-full">
            <p class="font-semibold mb-4 text-lg">Aplikasi ini dibuat oleh:</p>
            
            <table class="w-full text-sm border border-gray-300 rounded-lg overflow-hidden">
                <tbody>
                    <tr class="border-b">
                        <td class="font-medium w-32 bg-gray-100 px-4 py-2">Nama</td>
                        <td class="px-4 py-2">Hayba Angelie Putria Hasan</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium w-32 bg-gray-100 px-4 py-2">Prodi</td>
                        <td class="px-4 py-2">D3 - Manajemen Informatika</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium w-32 bg-gray-100 px-4 py-2">NIM</td>
                        <td class="px-4 py-2">2331730113</td>
                    </tr>
                    <tr>
                        <td class="font-medium w-32 bg-gray-100 px-4 py-2">Tanggal</td>
                        <td class="px-4 py-2">20 September 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
