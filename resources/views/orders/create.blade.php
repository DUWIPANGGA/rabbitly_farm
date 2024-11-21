@extends('layouts.app')

@section('content')
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
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="hover:underline">
                            <i class="fas fa-sign-out-alt" title="Logout"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Form Pemesanan -->
    <div class="container mx-auto mt-6 p-6 border rounded-lg shadow-md bg-white">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Form Pemesanan</h2>
        <form action="{{ route('payments.create', ['id' => $product->id]) }}" method="GET">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium">Nama:</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium">Alamat:</label>
                <input type="text" name="alamat" id="alamat" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="mb-4">
                <label for="nomor_telepon" class="block text-sm font-medium">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="mb-4">
                <label for="produk" class="block text-sm font-medium">Produk:</label>
                <input type="text" name="produk" id="produk" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ $product->nama_kelinci }}" readonly>
            </div>
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium">Jumlah Produk:</label>
                <input type="number" name="jumlah" id="jumlah" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="mb-4">
                <label for="total_harga" class="block text-sm font-medium">Total Harga:</label>
                <input type="number" name="total_harga" id="total_harga" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ $product->harga }}" readonly>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Pesan</button>
        </form>
    </div>
@endsection
