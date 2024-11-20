<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        return view('admin.vacancy.index');
    }

    public function create()
    {
        return view('admin.vacancy.create');
    }

    public function edit(Vacancy $vacancy)
    {
        return view('admin.vacancy.edit', compact('vacancy'));
    }

    public function editBlock(Page $page, PageBlock $block)
    {
        return view('admin.vacancy.block.edit', compact('page', 'block'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::OPENING->value)
            ->first();

        return view('admin.vacancy.main-page-seo', compact('page'));
    }
}
