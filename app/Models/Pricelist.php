<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pricelist extends Model
{
    use HasFactory;
    protected $table = 'pricelists';

    protected $fillable = ['tipe', 'kapasitas','deskripsi', 'list_pekerjaan', 'harga'];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
           ->format('l, d F Y H:i');
    }

}
