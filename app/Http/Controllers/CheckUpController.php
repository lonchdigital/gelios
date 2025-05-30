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

        $url['ua'] = url('/') . '/ua/check-up';
        $url['ru'] = url('/') . '/check-up';
        $url['en'] = url('/') . '/en/check-up';

        return view('site.check-up.index', compact('checkUps', 'page', 'url'));
    }
}
