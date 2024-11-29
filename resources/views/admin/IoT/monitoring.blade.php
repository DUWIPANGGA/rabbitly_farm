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
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Sales Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-30 py-2 px-4 text-left">ID Perangkat</th>
                        <th class="py-2 px-4 text-left">Nama Lokasi</th>
                        <th class="py-2 px-4 text-left">Tanggal & Waktu</th>
                        <th class="py-2 px-4 text-left">Status Lampu</th>
                        <th class="py-2 px-4 text-left">Keterangan</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($dataall))
                    @foreach ($dataall as $device)
                        <tr>
                            <td class="py-2 px-4">{{ $device->id_device }}</td>
                            <td class="py-2 px-4">{{ $device->nama_device }}</td>
                            <td class="py-2 px-4">{{ $device->updated_at }}</td>
                            <td class="py-2 px-4">
                                <span class="{{ $device->status_lampu == 1 ? 'bg-green-500' : 'bg-gray-500' }} text-white inline-block py-1 px-3 w-full rounded-full text-xs">
                                    {{ $device->status_lampu == 1 ? 'Menyala' : 'Mati' }}
                                </span>
                            </td>
                            <td class="py-2 px-4">
                                {{ $device->status_lampu == 1 ? 'Lampu menyala otomatis saat terdeteksi aktivitas' : 'Lampu mati tidak terdeteksi aktivitas' }}
                            </td>
                            <td class="py-2 px-4">
                                <form action="{{ route('history.destroy', $device->id_history) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-full text-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus perangkat ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                <form action="{{ route('devices.destroyAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-700 text-white py-2 px-4 rounded-lg text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus semua perangkat?')">
                        Delete All
                    </button>
                </form>
            </div>
        </div>
        
        
    </div>
</body>

</html>
