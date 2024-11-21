<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kelinci',
        'umur',
        'stok',
        'harga',
        'image_path', // Tambahkan ini untuk menyimpan jalur gambar
    ];
}
