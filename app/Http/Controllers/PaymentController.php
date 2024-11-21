<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Menampilkan form pembayaran berdasarkan ID produk
    public function create($id)
    {
        // Mengambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hitung total harga (harga produk dikali jumlah)
        $total_harga = $product->harga; // Ganti dengan logika perhitungan yang sesuai

        // Mengirim data produk dan total_harga ke view
        return view('payments.create', compact('product', 'total_harga'));
    }

    // Menyimpan data pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'jumlah_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
            'alamat_pengiriman' => 'required|string',
        ]);

        // Simpan data pembayaran ke dalam database
        $payment = Payment::create([
            'order_id' => $request->order_id,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'tanggal_pembayaran' => now(),
            'status' => 'completed',
        ]);

        // Redirect setelah pembayaran berhasil
        return redirect()->route('payments.show', ['id' => $payment->id]);
    }

    // Menampilkan detail pembayaran setelah berhasil disimpan
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.show', compact('payment'));
    }
}
