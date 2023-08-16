<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'paid_amount',
        'discount',
        'price',
        'tax',
        'status',
        'client_id',
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->ref = implode('', array_map(fn () => random_int(0, 9), range(1, 10)));
        });
    }
}
