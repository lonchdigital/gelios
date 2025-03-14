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

        $url['ua'] = url('/') . '/ua/akczii-i-speczialnye-predlozheniya';
        $url['ru'] = url('/') . '/akczii-i-speczialnye-predlozheniya';
        $url['en'] = url('/') . '/en/akczii-i-speczialnye-predlozheniya';

        return view('site.promotion.index', compact('promotions', 'page', 'url'));
    }

    public function show(Promotion $promotion)
    {
        $url['ua'] = url('/') . '/ua/akczii-i-speczialnye-predlozheniya/' . $promotion->slug;
        $url['ru'] = url('/') . '/akczii-i-speczialnye-predlozheniya/' . $promotion->slug;
        $url['en'] = url('/') . '/en/akczii-i-speczialnye-predlozheniya/' . $promotion->slug;

        $promotions = Promotion::where('id', '!=', $promotion->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $page = Page::where('type', PageType::SHARESITEM->value)
            ->with('translations')
            ->first();

        return view('site.promotion.show', compact('promotion', 'promotions', 'page', 'url'));
    }
}
