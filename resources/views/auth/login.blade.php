<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FruitStock</title>
    <!-- Memanggil Tailwind CSS via CDN (Jalan pintas tanpa NPM) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden">
        
        <!-- Efek gradasi hijau di pojok kanan atas form (meniru desain UI) -->
        <div class="absolute w-64 h-64 bg-green-100 rounded-full blur-3xl opacity-50 top-1/4 right-1/3"></div>

        <!-- Card Login -->
        <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 w-[420px] relative z-10">
            
            <!-- Header & Logo -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-50">
                    <!-- Ikon Apel/Buah sederhana -->
                    <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-green-700 tracking-tight">FruitStock</h1>
                <h2 class="text-lg text-gray-900 font-semibold mt-2">Welcome Back!</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan masuk ke akun Anda</p>
            </div>

            <!-- Menampilkan pesan error jika login gagal -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Input -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2" for="email">Username / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent text-sm transition-colors" placeholder="Masukkan email" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider" for="password">Password</label>
                        <a href="#" class="text-xs text-green-700 hover:underline">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent text-sm transition-colors" placeholder="••••••••" required>
                        <!-- Icon Mata -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                    LOGIN
                </button>
            </form>

            <div class="text-center mt-8 text-xs text-gray-400">
                &copy; 2026 FruitStock v1.0.0
            </div>
        </div>
    </div>

</body>
</html>