<?php

use Illuminate\Support\Facades\Route;

$items = $redirects = config('redirects');

if (!empty($items)) {
    foreach ($items as $item) {
        Route::get($item['from'], function () use ($item) {
            return redirect()->away(config('app.url') . $item['to'], 301);
        })->withoutMiddleware('trimSlash');
    }
}
