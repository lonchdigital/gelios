<?php

namespace App\Http\Controllers;

use App\Models\CheckUp;
use Illuminate\Http\Request;

class CheckUpController extends Controller
{
    public function index()
    {
        $checkUps = CheckUp::get();

        return view('site.check-up.index', compact('checkUps'));
    }
}
