<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceController extends Controller
{   
    public function index()
    {
        $servicesp = \App\Models\Service::where('status', 1)->orderby('order', 'ASC')->get();
        $services = $this->paginated($servicesp->toBase()->translate(App::getLocale(), 'fallbackLocale'),6);

        return view('service.index',compact('services','servicesp'));
    }

    public function show(){
        $servicesp = \App\Models\Service::where('status', 1)
            ->orderby('order', 'ASC')
            ->with('includedServices')
            ->get();
        $services = $servicesp->translate(App::getLocale(), 'fallbackLocale');
        $service = $services->where('slug', Request()->slug)->where('status', 'PUBLISHED')->first();
        $activeFaqs = \App\Models\Faq::where('active', true)
            ->take(10)
            ->get();

        if ($service) {
            return view('service.show',compact('service','services','activeFaqs'));
        }
    }

    public function paginated($services,$perPage){
        // Paginate the Eloquent collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $services->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedServices = new LengthAwarePaginator($currentPageItems, count($services), $perPage);
        // Set the path for the pagination links
        $paginatedServices->setPath(request()->url());

        return $paginatedServices;
    }
}
