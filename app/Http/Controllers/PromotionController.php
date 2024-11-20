<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::get();

        $page = Page::where('type', PageType::SHARES)
            ->with('pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        return view('site.promotion.index', compact('promotions', 'page'));
    }

    public function show(Promotion $promotion)
    {
        $promotions = Promotion::where('id', '!=', $promotion->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $page = Page::where('type', PageType::SHARESITEM->value)
            ->with('translations')
            ->first();

        return view('site.promotion.show', compact('promotion', 'promotions', 'page'));
    }
}
