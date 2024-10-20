<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Page;
use App\Models\Test;

class PriceController extends Controller
{
    public function index(Page $page)
    {
        return view('admin.prices.index', compact('page'));
    }
    public function createTest(Page $page)
    {
        $test = null;
        return view('admin.prices.tests.edit', compact('page', 'test'));
    }
    public function editTest(Page $page, Test $test)
    {
        return view('admin.prices.tests.edit', compact('page', 'test'));
    }

}
