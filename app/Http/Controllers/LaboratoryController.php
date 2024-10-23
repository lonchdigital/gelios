<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use App\Models\Page;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        $cities = LaboratoryCity::with('laboratories')->get();

        $page = Page::where('type', PageType::LABORATORY)
            ->with('pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        return view('site.laboratory.index', compact('cities', 'page'));
    }
}
