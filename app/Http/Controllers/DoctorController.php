<?php

namespace App\Http\Controllers;

use App\Enums\DoctorCategoryType;
use App\Enums\PageType;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Page;
use App\Models\Specialization;
use App\Services\Site\MetaService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $types = [
            DoctorCategoryType::ADULT->value,
            DoctorCategoryType::CHILDREN->value,
        ];

        $doctors = Doctor::paginate(10);

        $categories = DoctorCategory::get();

        $adultCategories = DoctorCategory::where('type', DoctorCategoryType::ADULT->value)
            ->get();

        $childrenCategories = DoctorCategory::where('type', DoctorCategoryType::ADULT->value)
            ->get();

        $page = Page::where('type', PageType::DOCTOR->value)
            ->with('translations')
            ->first();

        return view('site.doctors.index', compact(
            'doctors',
            'categories',
            'page',
            'types'
        ));
    }

    public function show(Doctor $doctor)
    {
        $page = Page::where('type', PageType::ONEDOCTOR->value)
            ->with('translations')
            ->first();

        $service = resolve(MetaService::class);

        $seo = $service->getMeta($page->title, $page->meta_title, $page->meta_description);

        return view('site.doctors.show', compact('doctor', 'page', 'seo'));
    }
}
