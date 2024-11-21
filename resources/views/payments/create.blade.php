@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

<header class="header">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
            <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
        </div>
        <h1 class="text-xl font-bold">Form Payments</h1>
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

<div class="container mx-auto mt-6 p-6 border rounded-lg shadow-md bg-gray-100">
    <form action="{{ route('payments.store') }}" method="POST">

        @csrf
        <div class="flex items-center mb-4">
            <div class="ml-4">
                <h2 class="font-semibold">Produk dipesan</h2>
                <input type="number" name="jumlah" value="1" min="1" class="w-16 border border-indigo-300 rounded-md p-1">
            </div>
        </div>
        <div class="mb-4">
            <label for="alamat_pengiriman" class="block text-sm font-medium">Alamat pengiriman :</label>
            <input type="text" name="alamat_pengiriman" id="alamat_pengiriman" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>
        <div class="mb-4">
            <label for="metode_pembayaran" class="block text-sm font-medium">Metode Pembayaran:</label>
            <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>
        <div class="mb-4">
            <label for="jumlah_pembayaran" class="block text-sm font-medium">Jumlah Pembayaran:</label>
            <input type="text" name="jumlah_pembayaran" id="jumlah_pembayaran"
                   class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                   readonly value="{{ number_format($total_harga, 2, ',', '.') }}">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Bayar</button>
    </form>
</div>

<footer class="mt-6 text-center">
    <p class="text-sm text-gray-500">©2024 Website Kelinci Penjualan</p>
</footer>

@endsection
