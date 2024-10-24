<?php

namespace App\Http\Controllers\Admin;

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
}
