<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f9fafb;
            /* Background color */
        }

        .header {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
            /* Header gradient */
            color: white;
        }

        .header h2 {
            font-weight: 700;
        }

        .logout-button {
            background-color: #ef4444;
            /* Logout button color */
        }

        .logout-button:hover {
            background-color: #dc2626;
            /* Darker on hover */
        }

        .welcome-message {
            font-size: 1.25rem;
            /* Welcome message font size */
            font-weight: bold;
        }

        .container {
            border-radius: 8px;
            /* Rounded corners */
            overflow: hidden;
            /* Ensure rounded corners */
        }

        .product-image {
            width: 80px;
            /* Image width */
            height: 80px;
            /* Image height */
            object-fit: cover;
            /* Maintain aspect ratio */
            border-radius: 8px;
            /* Rounded image corners */
        }

        .product-table {
            width: 100%;
            /* Table width */
        }

        .info-section {
            background: #ffffff;
            /* Background for info sections */
            border-radius: 8px;
            /* Rounded corners */
            padding: 20px;
            /* Padding */
            margin-bottom: 20px;
            /* Margin */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        .logo {
            display: flex;
            /* Align logo and text */
            align-items: center;
            /* Center vertically */
        }

        .logo img {
            height: 40px;
            /* Set a height for the logo */
            margin-right: 8px;
            /* Space between logo and text */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Header -->
    <header class="header shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="logo">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo">
                <span class="text-lg font-semibold">RABITLY FARM</span>
            </div>
            <div class="flex items-center space-x-4">
                <nav class="flex space-x-4">
                    <a href="shop" class="text-gray-200 hover:text-white flex items-center">
                        <i class="fas fa-shopping-cart mr-1"></i> Shop
                    </a>
                    <a href="about" class="text-gray-200 hover:text-white flex items-center">
                        <i class="fas fa-info-circle mr-1"></i> About
                    </a>
                    <a href="contact" class="text-gray-200 hover:text-white flex items-center">
                        <i class="fas fa-envelope mr-1"></i> Contact
                    </a>
                </nav>
                <div class="text-gray-200 flex items-center">
                    <i class="fas fa-user-circle mr-1"></i>
                    <span>User Account</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 logout-button text-white rounded-md transition duration-200 flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="p-6">
        <!-- Welcome Message -->
        <div class="info-section">
            <p class="welcome-message">Selamat datang! Di bawah ini adalah produk kelinci yang tersedia untuk Anda.</p>
        </div>

        <!-- Available Products Section -->
        <h3 class="font-semibold text-lg mb-4">Produk Tersedia</h3>
        <table class="product-table border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border border-gray-300">Gambar</th>
                    <th class="px-4 py-2 border border-gray-300">Jenis Kelinci</th>
                    <th class="px-4 py-2 border border-gray-300">Umur (bulan)</th>
                    <th class="px-4 py-2 border border-gray-300">Stok</th>
                    <th class="px-4 py-2 border border-gray-300">Harga</th>
                    <th class="px-4 py-2 border border-gray-300">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border border-gray-300">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                    alt="{{ $product->nama_kelinci }}" class="product-image">
                            @else
                                <img src="{{ asset('default-image.png') }}" alt="Default Image" class="product-image">
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-300">{{ $product->nama_kelinci }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $product->umur }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $product->stok }}</td>
                        <td class="px-4 py-2 border border-gray-300">Rp. {{ number_format($product->harga, 2) }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <p class="mt-2">
                                {{ $product->deskripsi_kelinci ?? 'tersedia' }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Care Tips Section -->
        <div class="info-section mt-8">
            <h3 class="font-semibold text-lg mb-4">Tips Perawatan Kelinci</h3>
            <ul class="list-disc list-inside">
                <li>Berikan makanan segar dan air bersih setiap hari.</li>
                <li>Jaga kebersihan kandang secara rutin.</li>
                <li>Berikan tempat bermain untuk kelinci agar tetap aktif.</li>
                <li>Periksalah kesehatan kelinci secara berkala.</li>
            </ul>
        </div>
    </div>
</body>

</html>
