<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
class Communication extends Model
{
    use Translatable;
    protected $translatable = ['address','workingtime','question','res_question','about_us','message','whatsapp_greeting_msg','title','excerpt'];
}
