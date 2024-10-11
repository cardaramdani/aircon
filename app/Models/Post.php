<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug','body', 'user_id', 'published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
           ->format('l, d F Y H:i');
    }

}
