<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use App\Models\Page;
use App\Enums\PageType;
use App\Models\PageTextBlock;

class HospitalController extends Controller
{
    public function show()
    {
        $page = Page::where('type', PageType::HOSPITAL->value)->first();
        $pageTextBlock = PageTextBlock::where('number', 1)->where('page_id', $page->id)->first();

        return view('site.pages.hospital',[
            'page' => $page,
            'pageTextBlock' => $pageTextBlock
        ]);
    }
}