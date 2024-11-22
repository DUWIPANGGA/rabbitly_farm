<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\iotController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/admin/rekap/penjualan', [SaleController::class, 'index'])->name('admin.rekap.penjualan');
Route::resource('sales', SaleController::class);

/// Rute untuk menampilkan form pembayaran berdasarkan ID produk
Route::get('/payments/create/{id}', [PaymentController::class, 'create'])->name('payments.create');

// Rute untuk menampilkan detail pembayaran (misalnya, untuk melihat detail setelah proses pembayaran)
Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

// Rute untuk menyimpan data pembayaran
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');


//Rute untuk manajemen produk
Route::resource('shop', ShopController::class);
// Rute untuk menampilkan form pemesanan
Route::get('/orders/create', [OrderController::class, 'showOrderForm'])->name('orders.create'); // Menggunakan showOrderForm
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // <-- Tambahkan ini
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Rute untuk daftar pemesanan
Route::post('/orders/{id}/status/{status}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


Route::get('/', function () {
    return view('welcome');
});

// Combined dashboard route to fetch products and use middleware
Route::get('/dashboard', function () {
    // Fetch all products from the database
    $products = Product::all();

    // Return the dashboard view with products data
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard'); // Ensure this route uses the same middleware as the previous one

Route::view('/about', 'about')->middleware('auth')->name('about');
Route::view('/contact', 'contact')->middleware('auth')->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk admin dengan middleware auth dan admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Rute untuk dashboard admin
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard/device', [HomeController::class, 'add'])->name('add-device');
    Route::delete('/admin/dashboard/device', [HomeController::class, 'delete'])->name('delete-device');
    Route::put('/admin/dashboard/device', [HomeController::class, 'edit'])->name('edit-device');
    Route::get('/admin/monitoring', [iotController::class, 'show'])->name('monitoring-iot');

    Route::get('/api/devices', [DeviceController::class, 'getDevices']);
    Route::post('/api/devices', [DeviceController::class, 'saveState']);

    // Rute untuk kelola pesanan
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('admin/orders', [OrderController::class, 'store'])->name('admin.orders.store'); // <-- Tambahkan ini

    // Rute untuk kelola produk
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products'); // Menampilkan daftar produk
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create'); // Menampilkan form untuk membuat produk
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin.products.save');

    // Rute untuk mengedit produk
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit'); // Menampilkan form untuk mengedit produk
    Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update'); // Memperbarui produk
    Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy'); // Menghapus produk
});

require __DIR__ . '/auth.php';
