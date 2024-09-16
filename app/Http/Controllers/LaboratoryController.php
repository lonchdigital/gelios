<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        $cities = LaboratoryCity::with('laboratories')->get();

        return view('site.laboratory.index', compact('cities'));
    }
}
