<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::get();

        return view('site.promotion.index', compact('promotions'));
    }

    public function show(Promotion $promotion)
    {
        $promotions = Promotion::where('id', '!=', $promotion->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('site.promotion.show', compact('promotion', 'promotions'));
    }
}
