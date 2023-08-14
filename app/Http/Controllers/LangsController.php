<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangsController extends Controller
{
    public function langs_handler(Request $request){
        $this->validate($request, [ 
            'lang' => 'required|alpha|min:2|max:2', 
        ]);
        
        $locale = $request->lang;
        
        if (! in_array($locale, ['it','ar','en','al'])) {
            abort(400);
        }
        
        $cookie = cookie('locale', $locale, 60 * 24 * 1); 

        return redirect()->back()->cookie($cookie);
    }
}
