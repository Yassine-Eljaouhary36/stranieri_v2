<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class IncludedService extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['title','body'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
