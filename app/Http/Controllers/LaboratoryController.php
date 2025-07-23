<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Article;
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

        $url['ua'] = url('/') . '/ua/laboratories';
        $url['ru'] = url('/') . '/laboratories';
        $url['en'] = url('/') . '/en/laboratories';
        $articles = Article::with('translations', 'articleBlocks', 'articleBlocks.translations')
            ->where('is_show_in_surgery_page', true)
            ->get();

        return view('site.laboratory.index', compact('cities', 'page', 'url', 'articles'));
    }

    public function prices()
    {
        $page = Page::where('type', PageType::LABORATORYPRICE)
            ->with('translations', 'pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        $prices = '';

        $url['ua'] = url('/') . '/ua/laboratories/prices';
        $url['ru'] = url('/') . '/laboratories/prices';
        $url['en'] = url('/') . '/en/laboratories/prices';

        return view('site.pages.laboratory-prices', compact('page', 'url'));
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
