<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Arial', sans-serif;
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

        /* Custom styling for submit button */
        .submit-button {
            padding: 0.75rem 2rem;
            background-color: #3b82f6;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #2563eb;
        }

        /* Custom form input styles */
        .form-input {
            border-radius: 5px;
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            width: 100%;
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
        <div class="form-header">
            <h2 class="font-semibold text-xl">Edit Product</h2>
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

<!-- Main Content -->
<div class="container">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="nama_kelinci" class="block text-lg font-medium">Nama Kelinci:</label>
        <input type="text" id="nama_kelinci" name="nama_kelinci" value="{{ old('nama_kelinci', $product->nama_kelinci) }}" required class="form-input mb-4">

        <label for="umur" class="block text-lg font-medium">Umur:</label>
        <input type="number" id="umur" name="umur" value="{{ old('umur', $product->umur) }}" required class="form-input mb-4">

        <label for="stok" class="block text-lg font-medium">Stok:</label>
        <input type="number" id="stok" name="stok" value="{{ old('stok', $product->stok) }}" required class="form-input mb-4">

        <label for="harga" class="block text-lg font-medium">Harga:</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $product->harga) }}" required class="form-input mb-4">

        <label for="image" class="block text-lg font-medium">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*" class="form-input mb-4">

        <button type="submit" class="submit-button">Perbarui Produk</button>
    </form>
</div>

</body>
</html>
