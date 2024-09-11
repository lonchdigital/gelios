<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::paginate(9);

        $categories = DoctorCategory::get();

        $specializations = Specialization::get();

        return view('site.doctors.index', compact('doctors', 'categories', 'specializations'));
    }

    public function show(Doctor $doctor)
    {
        return view('site.doctors.show', compact('doctor'));
    }
}
