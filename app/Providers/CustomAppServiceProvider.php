<?php

namespace App\Providers;

use App\Models\Communication;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Support\ServiceProvider;
use App\Models\Testimonail;
use Illuminate\Support\Facades\App;

// use Illuminate\Support\Facades\App;

class CustomAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('testimonials', function () {
            $testimonials = Testimonail::where('active', true)->get();
            return $testimonials->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('partners', function () {
            $partners = Partner::where('active', true)->get();
            return $partners->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('team', function () {
            $team = Team::where('active', true)->get();
            return $team->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('offers', function () {
            $offers = Offer::where('status', 'PUBLISHED')->take(5)->get(); 
            return $offers->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('communication', function () {
            $communication = Communication::get()->first();
            return $communication->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('services', function () {
            $services = Service::where('status', 1)->orderby('order', 'ASC')->take(4)->get(); 
            return $services->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('servicesWithIncludedServices', function () {
            $servicesWithIncludedServices = Service::has('includedServices')->where('status', 1)->orderby('order', 'ASC')->take(3)->get(); 
            return $servicesWithIncludedServices->translate(App::getLocale(), 'fallbackLocale');
        });

        $this->app->singleton('pages', function () {
            $pages = Page::where('status', 'ACTIVE')->take(5)->get(); 
            return $pages->translate(App::getLocale(), 'fallbackLocale');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
