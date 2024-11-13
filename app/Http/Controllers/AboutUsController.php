<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Contact;
use App\Models\BriefBlock;
use App\Models\SectionImage;
use App\Models\PageMediaBlock;

class AboutUsController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::ABOUT->value)->first();
        $allSectionImages = SectionImage::where('page_id', $page->id)->get();

        $photos = $allSectionImages->where('type', 'photos')->sortBy('sort');
        if($photos->isNotEmpty() && $photos->count() > 5) {
            $photos = $photos->take(5);
        }

        return view('site.pages.about-us',[
            'page' => $page,
            'briefBlocks' => BriefBlock::where('page_id', $page->id)->orderBy('sort', 'asc')->get(),
            'pageMediaBlock' => PageMediaBlock::where('number', 1)->where('page_id', $page->id)->first(),
            'contacts' => Contact::all(),
            'сertificates' => $allSectionImages->where('type', 'сertificates')->sortBy('sort'),
            'photos' => $photos
        ]);
    }
}
