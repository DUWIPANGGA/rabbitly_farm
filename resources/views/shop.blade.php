<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Rabbitly Farm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Tambahkan Font Awesome -->
    <style>
        .header {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    <header class="header">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <div class="flex items-center">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
                <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
            </div>
            <nav>
                <ul class="flex space-x-4 text-white">
                    <li><a href="{{ url('/dashboard') }}" class="hover:underline"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:underline"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:underline"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:underline">
                            <i class="fas fa-sign-out-alt" title="Logout"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <main class="container mx-auto p-6">
        <h2 class="text-center text-2xl font-bold mb-6">Kelinci Tersedia</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Example of one product card, repeat for each product -->
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('default-image.png') }}"
                         alt="{{ $product->nama_kelinci }}"
                         class="w-full h-60 mb-4">
                    <div class="p-4 text-gray-800">
                        <h3 class="text-lg font-semibold">{{ $product->nama_kelinci }}</h3> <!-- Menambahkan nama jenis kelinci -->
                        <p>Usia: {{ $product->umur }} bulan</p>
                        <p>Harga: Rp. {{ number_format($product->harga, 2) }}</p>
                        <p>Stok: {{ $product->stok }}</p>
                    </div>
                    <a href="{{ route('orders.create', ['product_id' => $product->id]) }}"
                       class="block text-center py-2 w-full bg-blue-600 text-white rounded-b hover:bg-blue-700 transition">
                        Pesan
                    </a>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 mt-6 bg-gray-200 text-gray-700">
        &copy; 2024 Website Kelinci Penjualan
    </footer>
</body>

</html>
