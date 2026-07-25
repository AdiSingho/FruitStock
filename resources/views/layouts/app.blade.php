<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FruitStock - Inventory & POS')</title>
    
    <!-- Menggunakan Tailwind CSS via CDN untuk efisiensi slicing -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Konfigurasi warna kustom sesuai desain Anda -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fruit-green': '#006B4D',
                        'fruit-green-light': '#E6F4F1',
                        'fruit-bg': '#F8FAFC',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-fruit-bg font-sans text-gray-800 antialiased min-h-screen">
    
    <!-- Area ini akan diisi oleh konten dari halaman lain -->
    @yield('content')

</body>
</html>