<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Surgery;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    public function index()
    {
        $page = Page::where('type', PageType::SURGERY)
            ->with('pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        $directions = Surgery::with('surgeryBlocks', 'surgeryBlocks')
            ->get();

        $reviews = $page->reviews;

        $url['ua'] = url('/') . '/ua/vzroslym/hirurgiya';
        $url['ru'] = url('/') . '/vzroslym/hirurgiya';
        $url['en'] = url('/') . '/en/vzroslym/hirurgiya';

        return view('site.surgery.index', compact('page', 'directions', 'reviews', 'url'));
    }
}
