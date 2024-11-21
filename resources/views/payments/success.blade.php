@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 p-6 border rounded-lg shadow-md bg-gray-100 text-center">
    <div class="flex flex-col items-center">
        <!-- Success Icon -->
        <img src="{{ asset('storage/images/icon2.jpg') }}" alt="Icon Pembayaran Berhasil" class="h-20 w-25 mb-4">

        <!-- Success Message -->
        <h1 class="text-2xl font-bold mb-4">Pembayaran Telah Berhasil!</h1>
        <p class="mb-2">Terima Kasih atas Pembelian Anda!</p>
        <p>Pembayaran Anda telah berhasil diproses.</p>
        <p>Kami sangat menghargai kepercayaan Anda untuk berbelanja bersama kami.</p>

        <!-- Home Button -->
        <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Home</a>
    </div>
</div>

<!-- Footer -->
<footer class="mt-6 text-center">
    <p class="text-sm text-gray-500">©2024 Website Kelinci Penjualan</p>
</footer>
@endsection
