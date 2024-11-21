<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Rekap</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        th,
        td {
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

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #3b82f6;
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }

        .table-striped tbody tr:hover {
            background-color: #f1f5f9;
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
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center space-x-2 hover:underline">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Edit Sale Form -->
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Edit Sale</h1>
        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="buyer_name" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                <input type="text" name="buyer_name" id="buyer_name"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->buyer_name }}" required>
            </div>
            <div class="mb-4">
                <label for="sale_date" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
                <input type="date" name="sale_date" id="sale_date"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->sale_date }}" required>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="quantity" id="quantity"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->quantity }}" required>
            </div>
            <div class="mb-4">
                <label for="rabbit_type" class="block text-sm font-medium text-gray-700">Jenis Kelinci</label>
                <input type="text" name="rabbit_type" id="rabbit_type"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->rabbit_type }}" required>
            </div>
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <input type="text" name="payment_method" id="payment_method"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->payment_method }}" required>
            </div>
            <div class="mb-4">
                <label for="payment_status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <input type="text" name="payment_status" id="payment_status"
                    class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $sale->payment_status }}" required>
            </div>
            <button type="submit"
                class="btn btn-primary px-4 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-600">Update
                Sale</button>
        </form>
    </div>
</body>

</html>
