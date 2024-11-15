<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\DoctorComposer;
use App\Http\View\Composers\FooterComposer;
use App\Http\View\Composers\DirectionsComposer;
use App\View\Composers\FooterComposer as ComposersFooterComposer;
use App\View\Composers\HeaderComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('site.components.appointment-form', DoctorComposer::class);
        View::composer('site.*', DirectionsComposer::class);
        View::composer('site.parts.footer', FooterComposer::class);
        View::composer('site.parts.footer', ComposersFooterComposer::class);
        View::composer('site.parts.header', HeaderComposer::class);
    }
}
