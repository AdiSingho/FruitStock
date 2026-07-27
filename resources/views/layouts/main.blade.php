@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden bg-fruit-bg">
    
    <!-- Sidebar Navigasi -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shrink-0">
        <!-- Logo -->
        <div class="h-20 flex items-center justify-center border-b border-gray-100 px-6">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-fruit-green-light rounded-full flex items-center justify-center mb-1">
                    <svg class="w-5 h-5 text-fruit-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                </div>
                <span class="text-xl font-bold text-fruit-green leading-none">FruitStock</span>
                <span class="text-[10px] text-gray-500 uppercase tracking-widest mt-0.5">Inventory & POS</span>
            </div>
        </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <!-- Beranda -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-fruit-green-light text-fruit-green rounded-lg font-medium border-l-4 border-fruit-green">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Beranda
        </a>

        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 rounded-lg font-medium transition-colors border-l-4 {{ request()->routeIs('profile.edit') ? 'bg-fruit-green-light text-fruit-green border-fruit-green' : 'text-gray-600 hover:bg-gray-50 hover:text-fruit-green border-transparent' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Pengaturan Profil
        </a>

        <!-- Master Buah -->
        <a href="{{ route('buah.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            Master Buah
        </a>

        <!-- Kategori (Baru ditambahkan) -->
        <a href="{{ route('kategori.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 11h16M4 15h16M4 19h16"></path></svg>
            Kategori
        </a>

        <!-- Gudang -->
        <a href="{{ route('gudang.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Gudang
        </a>

        <!-- Supplier -->
        <a href="{{ route('supplier.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Supplier
        </a>

        <!-- QC & Retur -->
        <a href="{{ route('qc-retur.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            QC & Retur
        </a>

        <!-- POS / Kasir -->
        <a href="{{ route('transaksi.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-fruit-green rounded-lg font-medium transition-colors border-l-4 border-transparent">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            POS / Kasir
        </a>
    </nav>
        </nav>

        <!-- Tombol Logout -->
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Area Konten Utama -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- Header Atas -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <!-- Search Bar -->
            <form action="{{ route('buah.index') }}" method="GET" class="w-1/2 max-w-lg relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:border-fruit-green focus:ring-2 focus:ring-fruit-green-light text-sm transition-all" 
                    placeholder="Cari buah, stok...">
            </form>

            <!-- Profil & Notifikasi -->
            <div class="flex items-center space-x-6">
                <button class="relative text-gray-500 hover:text-fruit-green transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full"></span>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-sm">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=006B4D&color=fff" alt="Profile" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </header>

        <!-- Tempat Konten Halaman Disisipkan -->
        <div class="flex-1 overflow-y-auto p-8">
            @yield('main-content')
        </div>
        
    </main>
</div>
@endsection