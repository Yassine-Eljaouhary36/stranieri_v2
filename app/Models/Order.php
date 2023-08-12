<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'status',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
