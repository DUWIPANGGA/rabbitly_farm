<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class device_history extends Model
{
    use HasFactory;
    protected $table = 'device_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_device', 'status_lampu'
    ];
    public $timestamps = true;
}
