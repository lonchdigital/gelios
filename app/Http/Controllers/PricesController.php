<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;

class PricesController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::PRICES->value)->first();

        return view('site.pages.prices',[
            'page' => $page,
        ]);
    }
}
