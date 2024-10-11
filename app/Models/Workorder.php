<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'service_items',
    ];

    protected $casts = [
        'service_items' => 'array', // Menetapkan tipe data array untuk kolom service_items
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
