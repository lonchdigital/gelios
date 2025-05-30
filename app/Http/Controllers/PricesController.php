<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Services\Site\PricesService;
use Illuminate\Http\Request;

class PricesController extends Controller
{

    private PricesService $service;
    private Page $page;

    public function __construct(PricesService $service)
    {
        $this->service = $service;
        $this->page = Page::where('type', PageType::PRICES->value)->first();
    }

    public function page()
    {
        $url['ua'] = url('/') . '/ua/prices';
        $url['ru'] = url('/') . '/prices';
        $url['en'] = url('/') . '/en/prices';

        return view('site.pages.prices',[
            'page' => $this->page,
            'url' => $url,
        ]);
    }

    public function searchFilter(Request $request): array
    {
        $request->validate([
            'query' => 'required|array'
        ]);

        return $this->service->getFilteredItems($request, $this->page);
    }
}
