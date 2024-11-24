<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/card.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" language="javascript">
        var mqtt;
        var reconnectTimeout = 2000;
        var host = "broker.emqx.io";
        var port = 8083;
        var username = "rabbit_polindra"; // Replace with your username
        var password = "rabbit_polindra"; // Replace with your password

        // Function to handle successful connection
        function onConnect() {
            console.log("Connected to MQTT broker");

            mqtt.subscribe("rabbit_polindra/#", {
                onSuccess: function() {
                    console.log("Successfully subscribed to 'rabbit_polindra/#' topic");
                    fetch('/api/devices')
                        .then(response => response.json())
                        .then(devices => {
                            console.log(devices);
                            devices.forEach(device => {
                                const payload = JSON.stringify({
                                    msg: "ping",
                                    ID: device.id_device,
                                    pass: device.password,
                                    timestamp: new Date().toISOString()
                                });
                                sendMQTT(payload);
                                console.log(
                                    `Ping sent to ${device.nama_device} (${device.id_device})`);
                            });
                        })
                        .catch(err => console.error("Error fetching devices:", err));
                },
                onFailure: function(e) {
                    console.log("Failed to subscribe to 'rabbit_polindra/#' topic", e);
                }
            });

            // Publish a test message to the 'control/test' topic (just for testing)

        }

        function sendMQTT(messages) {
            var message = new Paho.MQTT.Message(messages);
            message.destinationName = "rabbit_polindra/control";
            mqtt.send(message);
        }
        const deviceCharts = {};

        // Fungsi untuk membuat atau memperbarui chart
        function suhuChart(labels, datas, elementId) {
            // Cek apakah chart untuk elemen ini sudah ada
            if (!deviceCharts[elementId]) {
                // Inisialisasi chart baru jika belum ada
                var ctx = document.querySelector(elementId).getContext('2d');
                deviceCharts[elementId] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Suhu',
                            data: datas,
                            backgroundColor: 'rgba(255, 165, 0, 0.2)',
                            borderColor: 'orange',
                            borderWidth: 2,
                            fill: false,
                            tension: 0.4,
                            pointRadius: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    color: '#666'
                                },
                                grid: {
                                    display: false // Menghilangkan grid pada sumbu Y
                                },
                            },
                            y: {
                                title: {
                                    display: false,
                                    text: 'Suhu (°C)',
                                    color: '#666'
                                },
                                grid: {
                                    display: false // Menghilangkan grid pada sumbu Y
                                },
                            }
                        }
                    }
                });
            } else {
                // Update chart yang sudah ada
                const chart = deviceCharts[elementId];
                chart.data.labels = labels; // Perbarui label
                chart.data.datasets[0].data = datas; // Perbarui data
                chart.update(); // Render ulang chart
            }
        }

        function onMessageArrived(message) {
            let payload = JSON.parse(message.payloadString);
            try {
                payload = JSON.parse(message.payloadString);
                console.log("Parsed payload:", payload);
            } catch (e) {
                console.error("Error parsing JSON:", e);
                return;
            }
            console.log("Message received on topic: " + message.destinationName);
            console.log("Message payload: " + message.payloadString);
            // alert(message.payloadString);
            if (payload.hasOwnProperty('msg') && payload.msg == "pong") {
                // try {
                // Cek ID dan password dalam pesan dengan yang ada pada elemen
                var deviceIds = payload.ID; // ID perangkat yang dikirimkan dalam pesan
                var devicePassword = payload.pass; // Password perangkat yang dikirimkan dalam pesan
                var deviceState = payload.state; // Status state perangkat yang dikirimkan dalam pesan (1 atau 0)

                // Cari semua elemen switch yang ada di halaman
                var switches = document.querySelectorAll('.tglswitch');
                // alert(deviceState + "=" + devicePassword + "=" + deviceIds + "=");
                switches.forEach(function(element) {
                    var storedDeviceId = element.getAttribute('data-id'); // ID perangkat yang ada di elemen
                    var storedDevicePassword = element.getAttribute(
                        'data-pass'); // Password perangkat yang ada di elemen
                    // Bandingkan ID dan password
                    if (storedDeviceId == deviceIds && storedDevicePassword == devicePassword) {
                        element.checked = deviceState == 1;
                        // Temukan elemen dengan ID dinamis
                        var lampIcon = document.querySelector(`#lamp-icon-${deviceIds}`);
                        if (lampIcon) {
                            console.log("Lamp icon found:", lampIcon);
                            // Menambahkan atau menghapus kelas berdasarkan deviceState
                            if (deviceState == 1) {
                                lampIcon.classList.remove('off-lamp');
                                lampIcon.classList.add('on-lamp');
                            } else {
                                lampIcon.classList.remove('on-lamp');
                                lampIcon.classList.add('off-lamp');
                            }
                        } else {
                            console.error("Lamp icon with ID #lamp-icon-" + deviceId + " not found.");
                        }
                    }
                });
            }
            if (payload.hasOwnProperty("type")) {
                // Ambil data dari payload
                let deviceId = payload.ID;
                let temperature = payload.temp.toFixed(1);
                let humidity = payload.hum.toFixed(1);

                // Perbarui elemen suhu dan kelembaban
                let temperatureElement = document.querySelector(`#temperature-${deviceId}`);
                let humidityElement = document.querySelector(`#humidity-${deviceId}`);

                if (temperatureElement) {
                    temperatureElement.innerHTML = `${temperature}°C`;
                }
                if (humidityElement) {
                    humidityElement.innerHTML = `${humidity} Rh`;
                }

                // Perbarui chart suhu
                const chartElementId = `#suhuChart-${deviceId}`;
                const currentDateTime = new Date().toLocaleTimeString(); // Label waktu
                if (document.querySelector(chartElementId)) {
                    // Ambil data chart saat ini
                    let currentChart = deviceCharts[chartElementId];

                    if (currentChart) {
                        // Tambahkan data baru ke chart
                        currentChart.data.labels.push(currentDateTime);
                        currentChart.data.datasets[0].data.push(parseFloat(temperature));

                        // Hapus data lama jika sudah terlalu banyak (misalnya, 20 titik)
                        if (currentChart.data.labels.length > 20) {
                            currentChart.data.labels.shift(); // Hapus label pertama
                            currentChart.data.datasets[0].data.shift(); // Hapus data pertama
                        }

                        currentChart.update(); // Render ulang chart
                    } else {
                        // Jika chart belum ada, buat baru
                        suhuChart([currentDateTime], [parseFloat(temperature)], chartElementId);
                    }
                }

            }
        }


        // Function to connect to the MQTT broker
        function mqttConnect() {
            console.log("Connecting to " + host + ":" + port);
            mqtt = new Paho.MQTT.Client(host, port, "clientjs");

            // Set up the message arrival handler
            mqtt.onMessageArrived = onMessageArrived;

            var options = {
                timeout: 3,
                userName: username, // Include username
                password: password,
                onSuccess: onConnect, // Callback for successful connection
                onFailure: function(message) {
                    console.log("Connection failed: " + message.errorMessage);
                    setTimeout(mqttConnect, reconnectTimeout);
                }
            };

            // Connect to the MQTT broker
            mqtt.connect(options);
        }

        // Automatically attempt to connect when the page loads
        window.onload = function() {
            mqttConnect();
        };
    </script>
    <style>
        body {
            background-color: #f9fafb;
        }

        .tglswitch {
            cursor: not-allowed;

        }

        .dashboard-header {
            background: linear-gradient(to right, #3b82f6, #ee7e22);
            color: white;
        }

        .fa-lightbulb {
            box-shadow: yellow;
            transition: color 0.3s ease;
        }

        .on-lamp {

            color: yellow;
            /* Lamp on, bright yellow */
        }

        .off-lamp {
            color: gray;
            /* Lamp off, dim gray */
        }

        /* Ensure that the icon is centered properly */
        .top-control-card {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150px;
        }

        /* Center text in the bottom card */
        .bot-control-card {
            text-align: center;
        }

        /* Hover effect for the card */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Custom style for switch */
        .switch input:checked+.slider {
            background-color: #4CAF50;
            /* Green for "on" state */
        }

        .switch input:checked+.slider:before {
            transform: translateX(20px);
            /* Move the toggle */
        }

        .slider {
            position: relative;
            display: inline-block;
            top: 0;
            width: 34px;
            height: 18px;
            border-radius: 50px;
            background-color: #ccc;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background-color: white;
            transition: 0.4s;
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
            <a href="{{ route('monitoring-iot') }}">Monitoring IoT</a>

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
    <div class="overflow-y-auto h-screen">
        @if (session('success'))
            <div id="successMessage"
                class="fixed top-8 inset-x-0 mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg w-full max-w-md z-50">
                <div class="relative">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer flex items-center"
                        onclick="closeSuccessMessage()">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.936 2.935a1 1 0 01-1.414-1.414l2.936-2.935-2.936-2.936a1 1 0 011.414-1.414L10 8.586l2.936-2.936a1 1 0 011.414 1.414l-2.936 2.936 2.936 2.935a1 1 0 010 1.414z" />
                        </svg>
                    </span>

                </div>
            </div>
        @endif



        <div class="flex-1 p-6">
            <div class="dashboard-header p-6 rounded-lg mb-6">
                <div class="flex items-center">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
                    <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
            </div>
            <div class="flex flex-row gap-6 h-auto w-[80%] pb-10 pt-10 overflow-x-auto overflow-y-hidden flex-wrap">
                @foreach ($yourDevice as $device)
                    <div class="card relative rounded-lg overflow-hidden h-[70%]" style="width: 250px; height: 260px;">
                        <!-- Tombol Edit dan Delete -->
                        <div class="absolute top-2 right-2 flex gap-2">
                            <!-- Tombol Edit -->
                            <button
                                onclick="showEditForm('{{ $device->id_device }}', '{{ $device->nama_device }}', '{{ $device->password }}', '{{ $device->status }}')"
                                class="text-gray-400 hover:text-blue-500 transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Tombol Delete -->
                            <form action="{{ route('delete-device', ['id' => $device->id_device]) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this device?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Isi Card -->
                        <div
                            class="border-primary top-control-card p-4 flex justify-center items-center bg-gradient-to-t from-blue-400 to-blue-500 rounded-lg shadow-lg">
                            <div class="text-center w-full">
                                <!-- Lamp Icon based on Switch -->
                                <i id="lamp-icon-{{ $device->id_device }}" class="fas fa-lightbulb text-white off-lamp"
                                    style="font-size: 6rem; transition: color 0.3s ease;"></i>
                            </div>
                        </div>

                        <!-- Bottom Control Card -->
                        <div class="bot-control-card text-center ">
                            <h4 class="text-gray-400 font-semibold text-white">{{ $device->nama_device }}</h4>
                            <!-- Switch to control lamp -->
                            <label class="switch">
                                <input class="tglswitch" type="checkbox" data-id="{{ $device->id_device }}"
                                    data-pass="{{ $device->password }}" {{ $device->status == 1 ? 'checked' : '' }}
                                    onchange="toggleLamp(this)">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="card relative rounded-lg overflow-hidden h-[70%]" style="width: 250px; height: 260px;">
                        <!-- Isi Card -->
                        <div
                            class="top-control-card p-4 flex justify-center items-center bg-gradient-to-t from-blue-400 to-blue-500 rounded-lg shadow-lg">
                            <div class="text-center w-full">
                                <!-- Ikon Suhu -->
                                <i class="fas fa-thermometer-half text-gray-500" style="font-size: 5rem;"></i>
                            </div>
                        </div>

                        <!-- Bottom Control Card -->
                        <div class="bot-control-card text-center mt-2 p-4">
                            <h4 class="text-gray-200 font-semibold text-gray-400"
                                id="temperature-{{ $device->id_device }}">0°C</h4>
                        </div>
                    </div>

                    <div class="card relative rounded-lg overflow-hidden h-[70%]"
                        style="width: 250px; height: 260px;">
                        <!-- Isi Card -->
                        <div
                            class="top-control-card p-4 flex justify-center items-center bg-gradient-to-t from-blue-400 to-blue-500 rounded-lg shadow-lg">
                            <div class="text-center w-full">
                                <!-- Ikon Kelembaban -->
                                <i class="fas fa-tint text-gray-500" style="font-size: 5rem;"></i>
                            </div>
                        </div>

                        <!-- Bottom Control Card -->
                        <div class="bot-control-card text-center mt-2 p-4">
                            <h4 class="text-gray-200 font-semibold text-gray-400"
                                id="humidity-{{ $device->id_device }}">0Rh</h4>
                        </div>
                    </div>
                    <div class="card relative rounded-lg overflow-hidden w-[100%] h-[70%]"
                        style="width: 250px; height: 260px;">
                        <canvas id="suhuChart-{{ $device->id_device }}" style="height: 200px;"></canvas>
                    </div>
                @endforeach

                <div class="card"
                    style="padding: 0; overflow: hidden; width: 250px; height: 250px; position: relative;"
                    onclick="showForm()">
                    <!-- Centered Add Icon -->
                    <div class="flex justify-center items-center h-full">
                        <i class="fas fa-plus text-4xl text-gray-600"></i> <!-- Tanda tambah di tengah -->
                    </div>
                </div>
            </div>


            <!-- IoT Monitoring Report for Rabbit Farm Lights -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <div class="p-4 border-b">
                    <h4 class="text-lg font-semibold">Laporan Monitoring IoT - Lampu Dan Suhu Kelinci</h4>
                </div>
                <div class="p-4">
                    <table class="min-w-full bg-white" id="deviceHistoryTable">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="w-30 py-2 px-4 text-left">ID Perangkat</th>
                                <th class="py-2 px-4 text-left">Nama Lokasi</th>
                                <th class="py-2 px-4 text-left">Tanggal & Waktu</th>
                                <th class="py-2 px-4 text-left">Status Lampu</th>
                                <th class="py-2 px-4 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="deviceForm"
                class="hidden absolute inset-0 bg-white bg-opacity-80 flex justify-center items-center z-10 p-4">
                <form class="bg-gray-100 p-6 rounded shadow-md w-full max-w-xs" method="POST"
                    action="{{ route('add-device') }}">
                    @csrf
                    <h3 class="text-lg font-semibold text-center mb-4">Add Device</h3>
                    <div class="mb-4">
                        <label for="deviceId" class="block text-sm font-semibold text-gray-700">Device ID</label>
                        <input type="text" id="deviceId" name="id_device"
                            class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter Device ID"
                            required />
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter Password"
                            required />
                    </div>
                    <div class="mb-4">
                        <label for="deviceName" class="block text-sm font-semibold text-gray-700">Device Name</label>
                        <input type="text" id="deviceName" name="nama_device"
                            class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter Device Name"
                            required />
                    </div>
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Device</button>
                        <button type="button" onclick="closeForm()"
                            class="bg-red-500 text-white px-4 py-2 rounded-md">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

        <div id="editFormModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
                <h3 class="text-lg font-semibold mb-4 text-center">Edit Device</h3>
                <form id="editDeviceForm" method="POST" action="{{ route('edit-device') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="editDeviceId" class="block text-sm font-semibold text-gray-700">Device
                            id</label>
                        <input type="text" id="editDeviceId" name="id_device"
                            class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editDeviceName" class="block text-sm font-semibold text-gray-700">Device
                            Name</label>
                        <input type="text" id="editDeviceName" name="nama_device"
                            class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editDevicePass" class="block text-sm font-semibold text-gray-700">Device
                            Password</label>
                        <input type="password" id="editDevicePass" name="password"
                            class="w-full p-2 border border-gray-300 rounded-md" required>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                        <button type="button" onclick="closeEditForm()"
                            class="bg-red-500 text-white px-4 py-2 rounded-md">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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

            function closeSuccessMessage() {
                document.getElementById('successMessage').classList.add('hidden');
            }

            document.addEventListener('click', function(e) {
                const successMessage = document.getElementById('successMessage');
                if (successMessage && !successMessage.querySelector('.relative').contains(e.target)) {
                    successMessage.classList.add('hidden');
                }
            });

            function showEditForm(id, name, status) {
                document.getElementById('editDeviceId').value = id;
                document.getElementById('editDeviceName').value = name;
                document.getElementById('editFormModal').classList.remove('hidden');
            }

            function closeEditForm() {
                document.getElementById('editFormModal').classList.add('hidden');
            }
            function showForm() {
                document.getElementById('deviceForm').classList.remove('hidden');
            }

            function closeForm() {
                document.getElementById('deviceForm').classList.add('hidden');
            }

            function onchange(checkbox) {
                // Get the data-id and data-pass attributes
                const deviceId = checkbox.getAttribute('data-id');
                const password = checkbox.getAttribute('data-pass');
                const state = checkbox.checked ? 'on' : 'off'; // Determine the state (on or off)

                const message = JSON.stringify({
                    ID: deviceId, 
                    pass: password, // Password
                    state: state // State (on or off)
                });
                const apidata = {
                    ID: deviceId, 
                    pass: password, // Password
                    state: checkbox.checked // State (on or off)
                };
                sendMQTT(message);
                fetch('/api/devices', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken, // Tambahkan CSRF token di header

                        },
                        body: JSON.stringify(apidata),
                    })
                    .then(response => response.json())
                    .then(data => {
            const tableBody = document.querySelector('#deviceHistoryTable tbody'); // Mengakses body tabel

            // Kosongkan tabel sebelum menambahkan data baru
            tableBody.innerHTML = '';

            // Loop melalui data dan tambahkan ke dalam tabel
            data.forEach(device => {
                const row = document.createElement('tr'); // Membuat baris baru

                // Membuat sel dan mengisinya dengan data
                const idCell = document.createElement('td');
                idCell.textContent = device.id_device;
                row.appendChild(idCell);

                const nameCell = document.createElement('td');
                nameCell.textContent = device.nama_device;
                row.appendChild(nameCell);

                const updatedAtCell = document.createElement('td');
                updatedAtCell.textContent = device.updated_at;
                row.appendChild(updatedAtCell);

                const statusCell = document.createElement('td');
                const statusSpan = document.createElement('span');
                statusSpan.classList.add('py-1', 'px-3', 'rounded-full', 'text-xs');
                if (device.status_lampu == 1) {
                    statusSpan.classList.add('bg-green-500', 'text-white','w-20','text-center','justify-center','inline-block');
                    statusSpan.textContent = 'Menyala';
                } else {
                    statusSpan.classList.add('bg-gray-500', 'text-white','w-20','text-center','justify-center','inline-block');
                    statusSpan.textContent = 'Mati';
                }
                statusCell.appendChild(statusSpan);
                row.appendChild(statusCell);

                const descriptionCell = document.createElement('td');
                descriptionCell.textContent = device.status == 1 
                    ? 'Lampu menyala otomatis saat terdeteksi aktivitas' 
                    : 'Lampu mati tidak terdeteksi aktivitas';
                row.appendChild(descriptionCell);

                // Menambahkan baris ke dalam body tabel
                tableBody.appendChild(row);
            });
        })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
            document.querySelectorAll('.tglswitch').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    onchange(checkbox);
                });
            });

            function toggleLamp(switchElement) {
                var deviceId = switchElement.getAttribute('data-id');
                var lampIcon = document.querySelector('#lamp-icon-' + deviceId);

                if (switchElement.checked) {
                    lampIcon.classList.add('on-lamp');
                    lampIcon.classList.remove('off-lamp');
                } else {
                    lampIcon.classList.add('off-lamp');
                    lampIcon.classList.remove('on-lamp');
                }
            }
        </script>

</body>

</html>
