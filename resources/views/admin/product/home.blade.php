<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f9fafb; /* Warna latar belakang */
            font-family: 'Arial', sans-serif; /* Font yang lebih bersih */
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .alert {
            background-color: #d1fae5;
            border: 1px solid #bbf7d0;
            color: #047857;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .table-header {
            background-color: #f9fafb;
        }
        .table-row:hover {
            background-color: #f1f5f9;
        }
        .action-button {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .nav-home {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .nav-home:hover {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
        }
        /* Ensures buttons in the action column are aligned */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px; /* Add some space between buttons */
        }
    </style>
</head>
<body>
 <!-- Header -->
 <header class="header">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
            <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
        </div>
        <nav>
            <ul class="flex space-x-4 items-center">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 hover:underline">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center space-x-2 hover:underline">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="py-12">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-2xl font-bold">Daftar Product</h1>
                        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white action-button">
                            <i class="fas fa-plus mr-2"></i> Tambah Product
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border-collapse border border-gray-300 mt-4">
                            <thead>
                                <tr class="table-header">
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Gambar</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Jenis Kelinci</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Umur (bulan)</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Stok</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Harga (IDR)</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="table-row">
                                    <td class="px-6 py-4 border-b border-gray-300">
                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->nama_kelinci }}" class="w-20 h-20 object-cover rounded-lg mx-auto">
                                        @else
                                            <span></span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $product->nama_kelinci }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $product->umur }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $product->stok }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ number_format($product->harga, 2) }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white action-button">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white action-button">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
