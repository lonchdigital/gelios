<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RobotsController extends Controller
{
    public function edit()
    {
        return view('admin.robots.edit');
    }
}
