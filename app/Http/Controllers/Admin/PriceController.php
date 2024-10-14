<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Page;
use App\Models\Test;

class PriceController extends Controller
{
    public function index()
    {
        return view('admin.prices.index');
    }
    public function createTest()
    {
        $test = null;
        return view('admin.prices.tests.edit', compact('test'));
    }
    public function editTest(Test $test)
    {
        return view('admin.prices.tests.edit', compact('test'));
    }

}
