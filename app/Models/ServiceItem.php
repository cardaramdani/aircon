<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',
        'list_pekerjaan',
        'tipe',
        'kapasitas',
        'harga',
    ];

}
