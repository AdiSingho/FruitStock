<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FruitStock - Professional Fruit Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8F9FF] font-inter text-[#3C4A42]">
    <div class="flex">
        <!-- Sidebar Navigation -->
        <aside class="w-[260px] h-screen bg-[#F8F9FF] border-r border-[#BBCABF] flex flex-col p-4">
            <div class="mb-8 p-4 border-b border-[#BBCABF]">
                <h1 class="font-bold text-[#006C49] text-xl">FruitStock</h1>
            </div>
            <nav class="space-y-2">
                <!-- Menggunakan request()->routeIs untuk menandai menu aktif -->
                <a href="{{ route('dashboard') }}" 
                class="flex items-center p-3 {{ request()->routeIs('dashboard') ? 'bg-[#E5EEFF] text-[#006C49] font-bold border-r-4 border-[#006C49]' : 'hover:bg-gray-100' }} rounded-lg">
                Beranda
                </a>
                
                <a href="{{ route('buah.index') }}" 
                class="flex items-center p-3 {{ request()->routeIs('buah.*') ? 'bg-[#E5EEFF] text-[#006C49] font-bold border-r-4 border-[#006C49]' : 'hover:bg-gray-100' }} rounded-lg">
                Master Buah
                </a>
                
                <a href="{{ route('stok.index') }}" 
                class="flex items-center p-3 {{ request()->routeIs('stok.*') ? 'bg-[#E5EEFF] text-[#006C49] font-bold border-r-4 border-[#006C49]' : 'hover:bg-gray-100' }} rounded-lg">
                Gudang & Stok
                </a>
                
                <a href="{{ route('qc-retur.index') }}" 
                class="flex items-center p-3 {{ request()->routeIs('qc-retur.*') ? 'bg-[#E5EEFF] text-[#006C49] font-bold border-r-4 border-[#006C49]' : 'hover:bg-gray-100' }} rounded-lg">
                QC & Retur
                </a>
                
                <a href="{{ route('transaksi.create') }}" 
                class="flex items-center p-3 {{ request()->routeIs('transaksi.*') ? 'bg-[#E5EEFF] text-[#006C49] font-bold border-r-4 border-[#006C49]' : 'hover:bg-gray-100' }} rounded-lg">
                POS / Kasir
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>