<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin.doctor.index');
    }

    public function create()
    {
        return view('admin.doctor.create');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctor.edit', compact('doctor'));
    }

    public function categoryIndex()
    {
        return view('admin.doctor-category.index');
    }

    public function categoryCreate()
    {
        return view('admin.doctor-category.create');
    }

    public function categoryEdit(DoctorCategory $category)
    {
        return view('admin.doctor-category.edit', compact('category'));
    }
}