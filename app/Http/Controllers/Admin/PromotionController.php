<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $page = Page::where('type', PageType::SHARES->value)
            ->first();

        return view('admin.promotion.index', compact('page'));
    }

    public function index2()
    {
        return view('admin.promotion.index2');
    }

    public function create()
    {
        $page = Page::where('type', PageType::SHARESITEM->value)
            ->first();

        return view('admin.promotion.create', compact('page'));
    }

    public function edit(Promotion $promotion)
    {
        $page = Page::where('type', PageType::SHARESITEM->value)
            ->first();

        return view('admin.promotion.edit', compact('promotion', 'page'));
    }

    public function createSlide(Page $page)
    {
        return view('admin.promotion.slider.create', compact('page'));
    }

    public function editSlide(Page $page, PageBlock $block)
    {
        return view('admin.promotion.slider.edit', compact('page', 'block'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::SHARES->value)
            ->first();

        return view('admin.promotion.main-page-seo', compact('page'));
    }

    public function onePageSeo()
    {
        $page = Page::where('type', PageType::SHARESITEM->value)
            ->first();

        return view('admin.promotion.one-page-seo', compact('page'));
    }

    public function editBlock(Page $page, PageBlock $block)
    {
        return view('admin.promotion.edit-block', compact('page', 'block'));
    }
}
