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
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 hover:underline">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
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

    <!-- Daftar Pesanan dan Pembayaran -->
    <div class="container mx-auto mt-6 p-6 border rounded-lg shadow-md bg-white">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Pesanan</h2>
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Alamat</th>
                    <th class="py-2 px-4 border-b">Nomor Telepon</th>
                    <th class="py-2 px-4 border-b">Produk</th>
                    <th class="py-2 px-4 border-b">Jumlah</th>
                    <th class="py-2 px-4 border-b">Total Harga</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $order->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->alamat }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->nomor_telepon }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->produk }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->jumlah }}</td>
                        <td class="py-2 px-4 border-b">Rp. {{ number_format($order->total_harga, 2) }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin cancel pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Sukses</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
