<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Page;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        return view('admin.hospital.index');
    }
    public function create()
    {
        $hospital = null;
        return view('admin.hospital.hospitals.edit', compact('hospital'));
    }
    public function editHospital(Hospital $hospital)
    {
        return view('admin.hospital.hospitals.edit', compact('hospital'));
    }

}
