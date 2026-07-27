@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Pengaturan Profil</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm border">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block font-bold mb-1">Nama</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border rounded-lg p-2" required>
        </div>

        <hr class="my-6">
        <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

        <div class="mb-4">
            <label class="block font-bold mb-1">Password Baru</label>
            <input type="password" name="password" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-6">
            <label class="block font-bold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-lg p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">Simpan Perubahan</button>
    </form>
</div>
@endsection