<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Ambil semua data pemesanan
        $orders = Order::all();

        // Return view untuk menampilkan data pemesanan
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function showOrderForm(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        // Return the view with the product details
        return view('orders.create', compact('product'));
    }


    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Validasi data pemesanan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'produk' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        // Simpan data pemesanan ke database
        Order::create($validatedData);

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        // Ambil data pemesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Return view untuk menampilkan form edit pemesanan
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'produk' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        // Cari data pemesanan berdasarkan ID dan update
        $order = Order::findOrFail($id);
        $order->update($validatedData);

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        // Hapus data pemesanan berdasarkan ID
        $order = Order::findOrFail($id);
        $order->delete();



        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
