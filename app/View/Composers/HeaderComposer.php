<?php

namespace App\View\Composers;

use App\Models\HeaderCity;
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
            ]);
        } catch (\Exception $e) {
        }

    }
}
