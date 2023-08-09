<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'hour_id',
    ];

    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
