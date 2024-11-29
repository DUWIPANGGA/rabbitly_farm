<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $table = 'device';
    protected $primaryKey = 'id_device';
    protected $keyType = 'string';
    protected $fillable = [
        'id','id_device', 'nama_device', 'status','password','maks_suhu','min_suhu'
    ];

    // Pastikan untuk menambahkan timestamp
    public $timestamps = true;
}
