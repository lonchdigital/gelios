<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\CheckUp;
use App\Models\CheckUpProgram;
use App\Models\Page;
use Illuminate\Http\Request;

class CheckUpController extends Controller
{
    public function index()
    {
        $page = Page::where('type', PageType::CHECKUP)
            ->first();

        return view('admin.check-up.index', compact('page'));
    }

    public function create()
    {
        return view('admin.check-up.create');
    }

    public function edit(CheckUp $checkUp)
    {
        return view('admin.check-up.edit', compact('checkUp'));
    }

    public function createProgram(CheckUp $checkUp)
    {
        return view('admin.check-up.create-program', compact('checkUp'));
    }

    public function editProgram(CheckUp $checkUp, CheckUpProgram $program)
    {
        return view('admin.check-up.edit-program', compact('checkUp', 'program'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::CHECKUP)
            ->first();

        return view('admin.check-up.main-page-seo', compact('page'));
    }

    public function onePageSeo()
    {
        $page = Page::where('type', PageType::CHECKUPITEM->value)
            ->first();

        return view('admin.check-up.one-page-seo', compact('page'));
    }
}
