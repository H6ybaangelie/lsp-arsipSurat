{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arsip Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="h-screen bg-gray-100 flex">

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-gray-800 text-white flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-200 z-50">
        <div class="p-4 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
            Menu
            {{-- Tombol close hanya di mobile --}}
            <button onclick="toggleSidebar()" class="md:hidden text-white text-2xl">&times;</button>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('surat.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">📂 Arsip Surat</a>
            <a href="{{ route('kategori.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">🗂 Kategori Surat</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-gray-700">ℹ️ About</a>
        </nav>
    </aside>

    {{-- Overlay hitam pas sidebar dibuka di mobile --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-40" onclick="toggleSidebar()"></div>

    {{-- Main Content --}}
    <main class="flex-1 p-6 overflow-y-auto w-full">
        {{-- Navbar atas untuk mobile --}}
        <div class="md:hidden mb-4">
            <button onclick="toggleSidebar()" class="bg-gray-800 text-white px-4 py-2 rounded">
                ☰ Menu
            </button>
        </div>

        {{-- Konten halaman --}}
        @yield('content')
    </main>

    {{-- JS untuk toggle sidebar --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

    {{-- JS halaman khusus --}}
    @yield('scripts')
</body>
</html>
