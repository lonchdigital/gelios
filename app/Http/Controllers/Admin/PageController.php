<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mainPage()
    {
        return view('admin.main-page.index');
    }

    public function mainPageEdit(PageBlock $block)
    {
        return view('admin.main-page.edit', compact('block'));
    }

    public function editHeader()
    {
        return view('admin.settings.edit-header');
    }

    public function editFooter()
    {
        return view('admin.settings.edit-footer');
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::MAINPAGE->value)
            ->first();

        return view('admin.main-page.seo', compact('page'));
    }

    public function editFooterLinks()
    {
        return view('admin.settings.edit-footer-links');
    }
}
