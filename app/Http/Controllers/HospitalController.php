<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Hospital;
use App\Models\PageTextBlock;

class HospitalController extends Controller
{
    public function show()
    {
        $page = Page::where('type', PageType::HOSPITAL->value)->first();
        $pageTextBlock = PageTextBlock::where('number', 1)->where('page_id', $page->id)->first();

        $url['ua'] = url('/') . '/ua/staczionar';
        $url['ru'] = url('/') . '/staczionar';
        $url['en'] = url('/') . '/en/staczionar';

        return view('site.pages.hospital',[
            'page' => $page,
            'pageTextBlock' => $pageTextBlock,
            'hospitals' => Hospital::all(),
            'url' => $url,
        ]);

    }
}