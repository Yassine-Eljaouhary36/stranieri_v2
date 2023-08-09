<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'DateMeeting',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->ref = Str::random(6). date('YmdHi');
        });
    }
}
