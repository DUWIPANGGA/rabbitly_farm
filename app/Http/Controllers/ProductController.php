<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all();
        return view('admin.product.home', compact('products'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('admin.product.create');
    }

    // Menampilkan dashboard dengan data produk
    public function dashboard()
    {
        $products = Product::all(); // Ambil data produk dari database
        return view('dashboard', compact('products')); // Kirim data ke view
    }

    // Menampilkan form pemesanan dengan informasi produk
    public function showOrderForm(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        return view('orders.create', compact('product'));
    }

    // Menyimpan produk baru
    public function save(Request $request)
    {
        // Validasi input termasuk gambar
        $validatedData = $request->validate([
            'nama_kelinci' => 'required|string|max:255',
            'umur' => 'required|integer',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan file gambar ke storage publik
        $imagePath = $request->file('image')->store('images', 'public');
        $validatedData['image_path'] = $imagePath;

        // Menyimpan data produk
        Product::create($validatedData);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    // Memperbarui produk yang ada
    public function update(Request $request, $id)
    {
        // Validasi input termasuk gambar
        $validatedData = $request->validate([
            'nama_kelinci' => 'required|string|max:255',
            'umur' => 'required|integer',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Menyimpan gambar baru jika diunggah
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus.');
    }
}
