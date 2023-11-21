<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Service extends Model
{
    use Translatable;
    protected $translatable = ['title','excerpt','body'];

    public function includedServices()
    {
        return $this->hasMany(IncludedService::class);
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }
}
