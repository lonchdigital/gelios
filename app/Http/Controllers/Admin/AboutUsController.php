<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function edit()
    {
        return view('admin.about-us.edit');
    }
}
