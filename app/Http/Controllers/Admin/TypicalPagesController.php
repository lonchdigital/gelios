<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Direction;
use App\Http\Controllers\Controller;
use App\Models\PageTextBlock;

class TypicalPagesController extends Controller
{
    public function index()
    {
        return view('admin.typical-pages.index', [
            'pages' => Page::where('type', PageType::TYPICAL->value)->get()
        ]);
    }

    public function create()
    {
        $page = null;
        return view('admin.typical-pages.create', [
            'page' => $page
        ]);
    }

    public function edit(Page $page)
    {
        return view('admin.typical-pages.edit', [
            'page' => $page
        ]);
    }

    
    public function blockCreate(Page $page)
    {
        return view('admin.typical-pages.blocks.edit', [
            'page' => $page,
            'pageTextBlock' => null
        ]);
    }

    public function blockEdit(Page $page, PageTextBlock $pageTextBlock)
    {
        return view('admin.typical-pages.blocks.edit', [
            'page' => $page,
            'pageTextBlock' => $pageTextBlock
        ]);
    }

}
