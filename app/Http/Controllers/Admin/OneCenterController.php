<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;

class OneCenterController extends Controller
{
    public function show()
    {
        return view('admin.one-center.edit');
    }
}
