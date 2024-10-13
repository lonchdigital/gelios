<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Enums\PageType;
use App\Models\BriefBlock;
use App\Models\SectionImage;
use App\Models\PageTextBlock;
use App\Models\PageMediaBlock;

class AboutUsController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::ABOUT->value)->first();
        $allSectionImages = SectionImage::where('page_id', $page->id)->get();

        return view('site.pages.about-us',[
            'page' => $page,
            'briefBlocks' => BriefBlock::where('page_id', $page->id)->orderBy('sort', 'asc')->get(),
            'pageMediaBlock' => PageMediaBlock::where('number', 1)->where('page_id', $page->id)->first(),
            'сertificates' => $allSectionImages->where('type', 'сertificates')->sortBy('sort'),
            'photos' => $allSectionImages->where('type', 'photos')->sortBy('sort')
        ]);
    }
}
