<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Direction;
use App\Http\Controllers\Controller;

class TextPagesController extends Controller
{
    public function index()
    {
        return view('admin.text-pages.index', [
            'pages' => Page::where('type', PageType::TEXT->value)->where('show_in_footer', 1)->get()
        ]);
    }

    public function edit(Page $page)
    {
        return view('admin.text-pages.edit', [
            'page' => $page
        ]);
    }

}
