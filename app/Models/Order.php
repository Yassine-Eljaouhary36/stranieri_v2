<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::now());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
    }

    public function getTotalAttribute()
    {
        return $this->Paid_amount - $this->Tax;
    }
}
