<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        return view('admin.laboratory.index');
    }

    public function create()
    {
        return view('admin.laboratory.create');
    }

    public function edit(Laboratory $laboratory)
    {
        return view('admin.laboratory.edit', compact('laboratory'));
    }

    public function cityIndex()
    {
        return view('admin.laboratory.city.index');
    }

    public function cityCreate()
    {
        return view('admin.laboratory.city.create');
    }

    public function categoryEdit(LaboratoryCity $city)
    {
        return view('admin.laboratory.city.edit', compact('city'));
    }
}