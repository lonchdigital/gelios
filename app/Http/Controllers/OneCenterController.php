<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Enums\PageType;
use App\Models\BriefBlock;
use App\Models\PageTextBlock;

class OneCenterController extends Controller
{
    public function page($slug)
    {
        $page = Page::where('type', PageType::ONECENTER->value)->where('slug', $slug)->first();
        if( is_null($page) ) { abort(404); }
        
        $allBriefBlocks = BriefBlock::where('page_id', $page->id)->get();
        $allPageTextBlocks = PageTextBlock::where('page_id', $page->id)->get();
        $doctors = Doctor::limit(10)->get();

        return view('site.pages.one-center',[
            'page' => $page,
            'slides' => $allBriefBlocks->where('type', 'slider')->sortBy('sort'),
            'briefBlocks' => $allBriefBlocks->where('type', 'briefBlocks')->sortBy('sort'),
            'pageTextBlockOne' => $allPageTextBlocks->where('number', 1)->first(),
            'pageTextBlockTwo' => $allPageTextBlocks->where('number', 2)->first(),
            'doctors' => $doctors,
        ]);
    }
}
