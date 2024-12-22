<?php

namespace App\Http\Controllers;

use App\Enums\DoctorCategoryType;
use App\Enums\PageType;
use App\Models\Article;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Page;
use App\Models\Specialization;
use App\Services\Site\MetaService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale();

        $types = [
            DoctorCategoryType::ADULT->value,
            DoctorCategoryType::CHILDREN->value,
        ];

        $query = Doctor::query()
            ->with(['category', 'translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            }]);

        if ($request->has('type') && in_array($request->type, $types)) {
            $query->whereHas('category', fn($q) => $q->where('type', $request->type));
        }

        if ($request->has('search')) {
            $query->whereHas('translations', function ($q) use ($request, $locale) {
                $q->where('locale', $locale)
                    ->where('title', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category')) {
            $category2 = DoctorCategory::whereHas('translations', function($q) use ($request) {
                $q->where('title', $request->category);
            })->first();

            $query->where('doctor_category_id', $category2->id);
        }

        $doctors = $query->latest()->get();

        if ($request->ajax()) {
            return view('site.doctors.partials.doctors_list', compact('doctors'))->render();
        }

        $categories = DoctorCategory::get();

        if ($request->has('type') && in_array($request->type, $types)) {
            $categories = DoctorCategory::where('type', $request->type)
                ->orWhere('type', DoctorCategoryType::BOTH->value)
                ->get();
        }

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
        $page = Page::where('type', PageType::DOCTOR->value)
            ->with('translations')
            ->first();

        $service = resolve(MetaService::class);

        $seo = $service->getMeta($page->title, $doctor->seo_title, $doctor->seo_description);

        $relatedArticles = Article::inrandomOrder()
            ->take(3)
            ->get();

        $reviews = $doctor->reviews;

        return view('site.doctors.show', compact('doctor', 'page', 'seo', 'relatedArticles', 'reviews'));
    }

    public function getCategoriesByType(Request $request)
    {
        $type = $request->type;

        $categories = DoctorCategory::where('type', $type)->get();

        return response()->json($categories);
    }

    public function getDoctorsByCategory($categoryId)
    {
        $doctors = Doctor::where('category_id', $categoryId)->get(['id', 'name']);
        return response()->json($doctors);
    }
}
