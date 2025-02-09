<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use App\Enums\PageType;
use Illuminate\View\View;
use App\Models\BriefBlock;
use App\Services\Admin\Directions\DirectionsService;

class DirectionsComposer
{
    public function compose(View $view)
    {
        $directionsService = app(DirectionsService::class);

        $view->with([
            'allDirections' => $directionsService->getCachedDirections(),
            'commonDirectionsBlock' => BriefBlock::where('type', 'directions')->first(),
            'allCenters' => Page::where('type', PageType::ONECENTER->value)->get()
        ]);
    }
}
