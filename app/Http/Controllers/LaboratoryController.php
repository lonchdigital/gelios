<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use App\Models\Page;
use App\Services\Site\LaboratoryPricesService;
use Database\Seeders\LaboratoryPriceSeeder;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        $cities = LaboratoryCity::with('laboratories')->get();

        $page = Page::where('type', PageType::LABORATORY)
            ->with('translations', 'pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        return view('site.laboratory.index', compact('cities', 'page'));
    }

    public function prices()
    {
        $page = Page::where('type', PageType::LABORATORYPRICE)
            ->with('translations', 'pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        $prices = '';

        return view('site.pages.laboratory-prices', compact('page'));
    }

    public function searchFilter(Request $request): array
    {
        $request->validate([
            'query' => 'required|array'
        ]);

        $service = resolve(LaboratoryPricesService::class);

        return $service->getFilteredItems($request);
    }
}
