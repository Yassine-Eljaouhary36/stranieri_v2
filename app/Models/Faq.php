<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Faq extends Model
{
    protected $table="faqs";
    use Translatable;
    protected $translatable = ['question','Answer'];
    use HasFactory;
}
