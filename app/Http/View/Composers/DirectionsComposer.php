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

        // $start = microtime(true);
        // $directions = $directionsService->buildTree($directionsService->getAllDirections(), true);
        // $end = microtime(true);
        // dd('Execution time: ' . ($end - $start) . ' seconds');

        $directions = $directionsService->buildTree($directionsService->getAllDirections(), true);
        // $directions = $directionsService->buildTree($directionsService->getAllDirections());
        // dd($directions, '222');
        $view->with([
            // 'allDirections' => collect([]),
            'allDirections' => $directions,
            'commonDirectionsBlock' => BriefBlock::where('type', 'directions')->first(),
            'allCenters' => Page::where('type', PageType::ONECENTER->value)->get()
        ]);
    }
}
