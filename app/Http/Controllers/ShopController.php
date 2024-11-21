<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan untuk mengimpor model Product
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all(); // Mengambil semua produk
        return view('shop', compact('products')); // Mengirim data ke view 'shop.blade.php'
    }

    // Menampilkan form untuk menambah produk
    public function create()
    {
        return view('shop.create'); // Mengembalikan view untuk menambah produk
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelinci' => 'required|string|max:255',
            'umur' => 'required|integer',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
        ]);

        // Menyimpan jalur gambar jika ada
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
        } else {
            $imagePath = null; // Jika tidak ada gambar, set null
        }

        // Membuat produk baru
        Product::create([
            'nama_kelinci' => $request->nama_kelinci,
            'umur' => $request->umur,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('shop')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID
        return view('shop.show', compact('product')); // Mengembalikan view untuk detail produk
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID
        return view('shop.edit', compact('product')); // Mengembalikan view untuk edit produk
    }

    // Memperbarui produk di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelinci' => 'required|string|max:255',
            'umur' => 'required|integer',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
        ]);

        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID

        // Menyimpan jalur gambar jika ada
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $product->image_path = $imagePath; // Update jalur gambar
        }

        // Memperbarui produk
        $product->update([
            'nama_kelinci' => $request->nama_kelinci,
            'umur' => $request->umur,
            'stok' => $request->stok,
            'harga' => $request->harga,
            // Tidak perlu update image_path jika tidak ada gambar baru
        ]);

        return redirect()->route('shop')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk dari database
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID
        $product->delete(); // Menghapus produk

        return redirect()->route('shop')->with('success', 'Produk berhasil dihapus.');
    }
}
