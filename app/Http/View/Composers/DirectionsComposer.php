<?php

namespace App\Http\View\Composers;

use App\Models\Direction;
use Illuminate\View\View;
use App\Services\Admin\Directions\DirectionsService;

class DirectionsComposer
{
    public function compose(View $view)
    {
        $directionsService = app(DirectionsService::class);
        $directions = $directionsService->buildTree($directionsService->getAllDirections(), true);
        $view->with('allDirections', $directions);
    }
}
