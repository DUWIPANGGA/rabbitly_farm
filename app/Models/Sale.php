<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari nama model
    protected $table = 'sales';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'buyer_name',
        'sale_date',
        'quantity',
        'rabbit_type',
        'payment_method',
        'payment_status',
    ];
}
