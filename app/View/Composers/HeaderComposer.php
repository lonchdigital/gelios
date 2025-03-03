<?php

namespace App\View\Composers;

use App\Models\HeaderCity;
use App\Models\Setting;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $firstCity = HeaderCity::first() ?? null;

        $secondCity = HeaderCity::where('id', '!=', $firstCity->id)->first() ?? null;

        try {
            $view->with([
                'firstCity'       => $firstCity,
                'secondCity'       => $secondCity,
                'headerImage'       => Setting::where('key', 'header_image')->first()->imageUrl ?? '',
            ]);
        } catch (\Exception $e) {
        }

    }
}
