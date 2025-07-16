<?php

namespace App\View\Composers;

use App\Models\HeaderCity;
use App\Models\Setting;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        // $firstCity = HeaderCity::first() ?? null;

        // $secondCity = HeaderCity::where('id', '!=', $firstCity->id)->first() ?? null;

        // $cities = HeaderCity::with('translations', 'headerAffiliates', 'headerAffiliates.translations')->take(2)->get();
        $cities = HeaderCity::with([
            'translations',
            'headerAffiliates.translations'
        ])->take(2)->get();

        $firstCity = $cities[0] ?? null;
        $secondCity = $cities[1] ?? null;

        $headerImage = Setting::where('key', 'header_image')->first()?->imageUrl ?? '';

        try {
            $view->with(compact('firstCity', 'secondCity', 'headerImage'));
            // $view->with([
            //     'firstCity'       => $cities[0] ?? null,
            //     // $firstCity,
            //     'secondCity'       => $cities[1] ?? null,
            //     // $secondCity,
            //     'headerImage'       => Setting::where('key', 'header_image')->first()->imageUrl ?? '',
            // ]);
        } catch (\Exception $e) {
        }

    }
}
