<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\CheckUp;
use App\Models\Page;
use Illuminate\Http\Request;

class CheckUpController extends Controller
{
    public function index()
    {
        $checkUps = CheckUp::get();

        $page = Page::where('type', PageType::CHECKUP->value)
            ->with('translations')
            ->first();

        return view('site.check-up.index', compact('checkUps', 'page'));
    }
}
