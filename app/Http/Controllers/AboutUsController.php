<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Contact;
use App\Models\BriefBlock;
use App\Models\SectionImage;
use App\Models\PageMediaBlock;
use App\Services\Site\MetaService;

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

        $service = resolve(MetaService::class);
        $seo = $service->getMeta($page->title, $page->meta_title, $page->meta_description);
        $seo[1] = strip_tags($seo[1]);
        $url['ua'] = url('/') . '/ua/about-us';
        $url['ru'] = url('/') . '/about-us';
        $url['en'] = url('/') . '/en/about-us';

        return view('site.pages.about-us',[
            'page' => $page,
            'briefBlocks' => BriefBlock::where('page_id', $page->id)->orderBy('sort', 'asc')->get(),
            'pageMediaBlock' => PageMediaBlock::where('number', 1)->where('page_id', $page->id)->first(),
            'contacts' => Contact::all(),
            'сertificates' => $allSectionImages->where('type', 'сertificates')->sortBy('sort'),
            'photos' => $photos,
            'seo' => $seo,
            'url' => $url,
        ]);
    }
}
