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
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center space-x-2 hover:underline">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Sales Table -->
    <div class="container">
        <!-- Title and Add New Sale Button -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Rekap Penjualan</h2>
            <a href="{{ route('sales.create') }}" class="btn btn-primary px-4 py-2 text-white rounded-md bg-blue-500 hover:bg-blue-600">Tambah Penjualan Baru</a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Sales Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal Penjualan</th>
                        <th>Jumlah</th>
                        <th>Jenis Kelinci</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->buyer_name }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->rabbit_type }}</td>
                        <td>{{ $sale->payment_method }}</td>
                        <td>{{ $sale->payment_status }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning px-4 py-2 text-white rounded-md bg-yellow-500 hover:bg-yellow-600">Ubah</a>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 text-white rounded-md bg-red-500 hover:bg-red-600" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
