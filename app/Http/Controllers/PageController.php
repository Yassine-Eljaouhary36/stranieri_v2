<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use TCG\Voyager\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', Request()->slug)->where('status', 'active')->first();
        if (!$page) {
            abort(404);
        }
        $page = $page->translate(App::getLocale(), 'fallbackLocale');
        return view('page', compact('page'));
    }

    public function faq()
    {
        $activeFaqs = \App\Models\Faq::where('active', true)
        ->take(10)
        ->get();
        return view('faq',compact('activeFaqs'));
    }

    public function about()
    {
        return view('about-us');
    }

}
