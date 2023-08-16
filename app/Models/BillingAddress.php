<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_one',
        'address_two',
        'country',
        'city',
        'zip',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
