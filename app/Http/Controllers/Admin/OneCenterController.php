<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\Page;
use App\Enums\PageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OneCenterController extends Controller
{
    public function index()
    {
        return view('admin.one-center.index', [
            'pages' => Page::where('type', PageType::ONECENTER->value)->get()
        ]);
    }

    public function create()
    {
        $page = null;
        return view('admin.one-center.edit', [
            'page' => $page
        ]);
    }

    public function edit(Page $page)
    {
        return view('admin.one-center.edit', [
            'page' => $page
        ]);
    }

}
