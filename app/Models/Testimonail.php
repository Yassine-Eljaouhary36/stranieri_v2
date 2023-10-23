<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Testimonail extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['content','author_name','author_title'];
}
