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
        'client_id',
        'order_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->ref = Str::random(6). date('YmdHi');
        });
    }
}
