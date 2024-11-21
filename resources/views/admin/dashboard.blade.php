<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/card.css">
    <style>
        body {
            background-color: #f9fafb;
        }

        .dashboard-header {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
            color: white;
        }

        .sidebar {
            background-color: #0b325e;
            min-height: 100vh;
            color: white;
        }

        .sidebar a {
            color: #9ca3af;
            display: block;
            padding: 12px 16px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #374151;
            color: #fff;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 4px 6px rgba(4, 4, 4, 0.1);
        }
    </style>
</head>

<body class="flex">

    <div class="sidebar w-64 bg-indigo-800 h-full p-4">
        <div class="text-gray-200 flex items-center mb-4">
            <i class="fas fa-user-circle mr-2"></i>
            <span class="font-semibold text-lg">Admin Account</span>
        </div>

        <nav>
            <a href="dashboard" class="text-white">Dashboard</a>
            <a href="products">Kelola Produk</a>
            <a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a>
            <a href="{{ route('admin.rekap.penjualan') }}">Rekap Penjualan</a>
            <a href="orders.store">Monitoring IoT</a>

        </nav>
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full mt-4 px-4 py-2 bg-red-600 text-white rounded-md">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
    </div>

    <!-- Main Content -->

    <div class="flex-1 p-6">
        <div class="dashboard-header p-6 rounded-lg mb-6">
            <div class="flex items-center">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
                <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
            </div>
        </div>


        <!-- Statistics Cards (Updated to Chart Style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
            <!-- Value of 1 Bitcoin Card -->
            <div class="card">
                <h4 class="text-lg font-semibold">Total Pemesanan </h4>
                <div class="flex items-center mt-4">
                    <div class="w-full h-2 bg-gray-200 rounded-lg relative">
                        <div class="h-2 bg-yellow-500 rounded-lg absolute top-0 left-0" style="width: 70%;"></div>
                    </div>
                    <span class="ml-4 text-sm font-bold">+7.12%</span>
                </div>
                <div class="flex mt-4 justify-between">
                    <div class="w-10 h-24 bg-indigo-500 rounded-md"></div>
                    <div class="w-10 h-16 bg-indigo-400 rounded-md"></div>
                    <div class="w-10 h-20 bg-yellow-400 rounded-md"></div>
                    <div class="w-10 h-10 bg-red-600 rounded-md"></div>
                    <div class="w-10 h-24 bg-indigo-500 rounded-md"></div>
                </div>
            </div>

            <!-- Most Sales Card with Line Chart -->
            <div class="card">
                <h4 class="text-lg font-semibold">Total Penjualan</h4>
                <div class="mt-50">
                    <canvas id="salesChart" style="height: 200px;"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="top-control-card" id="control-card-' . $i+$device_now . '">
                    <!-- <img src="assets/icon/lamp_off.png" alt=""> -->
                </div>
                <div class="bot-control-card">
                    <p ><h4 class="text-lg font-semibold">Lampu 1</h4></p>
                    <label class="switch" >
                        <input id="toggle" class="tglswitch" type="checkbox" onchange="">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- IoT Monitoring Report for Rabbit Farm Lights -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="p-4 border-b">
                <h4 class="text-lg font-semibold">Laporan Monitoring IoT - Lampu Dan Suhu Kelinci</h4>
            </div>
            <div class="p-4">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-20 py-2 px-4 text-left">ID Perangkat</th>
                            <th class="py-2 px-4 text-left">Nama Lokasi</th>
                            <th class="py-2 px-4 text-left">Tanggal & Waktu</th>
                            <th class="py-2 px-4 text-left">Status Lampu</th>
                            <th class="py-2 px-4 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">LMP001</td>
                            <td class="py-2 px-4">Kandang Utama</td>
                            <td class="py-2 px-4">2024-11-06 14:30</td>
                            <td class="py-2 px-4">
                                <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">Menyala</span>
                            </td>
                            <td class="py-2 px-4">Lampu menyala otomatis saat terdeteksi aktivitas</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">LMP002</td>
                            <td class="py-2 px-4">Kandang Belakang</td>
                            <td class="py-2 px-4">2024-11-06 13:15</td>
                            <td class="py-2 px-4">
                                <span class="bg-gray-500 text-white py-1 px-3 rounded-full text-xs">Mati</span>
                            </td>
                            <td class="py-2 px-4">Lampu mati, tidak ada aktivitas terdeteksi</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">LMP003</td>
                            <td class="py-2 px-4">Kandang Samping</td>
                            <td class="py-2 px-4">2024-11-06 12:45</td>
                            <td class="py-2 px-4">
                                <span class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs">Pending</span>
                            </td>
                            <td class="py-2 px-4">Status lampu sedang diperiksa</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Add the JavaScript for rendering the line chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    datasets: [{
                        label: 'Pelanggan',
                        data: [20000, 25000, 30000, 35000, 40000, 42000, 45000, 43000, 40000, 38000, 36000,
                            37000
                        ],
                        backgroundColor: 'rgba(255, 165, 0, 0.2)',
                        borderColor: 'orange',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false,
                            suggestedMin: 10000,
                            suggestedMax: 50000
                        }
                    }
                }
            });
        </script>

</body>

</html>
