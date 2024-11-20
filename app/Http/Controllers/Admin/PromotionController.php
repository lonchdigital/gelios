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
        return view('admin.promotion.index');
    }

    public function create()
    {
        return view('admin.promotion.create');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit', compact('promotion'));
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
}
