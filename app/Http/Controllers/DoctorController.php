<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Page;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::paginate(9);

        $categories = DoctorCategory::get();

        $specializations = Specialization::get();

        $page = Page::where('type', PageType::DOCTOR->value)
            ->with('translations')
            ->first();

        return view('site.doctors.index', compact('doctors', 'categories', 'specializations', 'page'));
    }

    public function show(Doctor $doctor)
    {
        $page = Page::where('type', PageType::ONEDOCTOR->value)
            ->with('translations')
            ->first();

        return view('site.doctors.show', compact('doctor', 'page'));
    }
}
