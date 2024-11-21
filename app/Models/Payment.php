<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan konvensi Laravel
    protected $table = 'payments';

    // Tentukan kolom yang dapat diisi massal
    protected $fillable = [
        'order_id',
        'jumlah_pembayaran',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'status',
    ];

    // Hubungkan dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
