<?php

namespace App\Providers;

use App\Http\View\Composers\DoctorComposer;
use App\Http\View\Composers\DirectionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    }
}
