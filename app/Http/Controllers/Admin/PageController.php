<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\HeaderAffiliate;
use App\Models\HeaderCity;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mainPage()
    {
        return view('admin.main-page.index');
    }

    public function mainPageEdit(PageBlock $block)
    {
        return view('admin.main-page.edit', compact('block'));
    }

    public function editHeader()
    {
        return view('admin.settings.edit-header');
    }

    public function editFooter()
    {
        return view('admin.settings.edit-footer');
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::MAINPAGE->value)
            ->first();

        return view('admin.main-page.seo', compact('page'));
    }

    public function editFooterLinks()
    {
        return view('admin.settings.edit-footer-links');
    }

    public function createSlide()
    {
        $page = Page::where('type', PageType::MAINPAGE->value)
            ->first();

        return view('admin.main-page.slider.create', compact('page'));
    }

    public function editSlide(PageBlock $block)
    {
        $page = Page::where('type', PageType::MAINPAGE->value)
            ->first();

        return view('admin.main-page.slider.edit', compact('page', 'block'));
    }

    public function createAffiliate(HeaderCity $city)
    {
        return view('admin.settings.affiliate.create', compact('city'));
    }

    public function editAffiliate(HeaderCity $city, HeaderAffiliate $affiliate)
    {
        return view('admin.settings.affiliate.edit', compact('city', 'affiliate'));
    }
}
