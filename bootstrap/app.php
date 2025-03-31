<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\ForceLocalePrefix;
use App\Http\Middleware\SetDefaultLanguage;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            // TODO:: set correct middleware for admin routes
            Route::middleware('web', 'auth') // 'admin', 'auth'
                ->group(base_path('routes/admin.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web', 'trimSuffix', 'lowercaseUrl')
                ->group(base_path('routes/web.php'));
        }

    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'setDefaultLanguage'      => SetDefaultLanguage::class,
            // 'forceLocalePrefix'       => ForceLocalePrefix::class,
            'trimSuffix'              => App\Http\Middleware\TrimRouteSuffix::class,
            'lowercaseUrl'            => App\http\Middleware\LowercaseUrl::class,
        ]);

        $middleware->group('auth', [
            App\Http\Middleware\AuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
