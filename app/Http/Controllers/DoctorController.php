<?php

namespace App\Http\Controllers;

use App\Enums\DoctorCategoryType;
use App\Enums\PageType;
use App\Models\Article;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorSpecialization;
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
            ->with(['specializations', 'category', 'translations' => function ($q) use ($locale) {
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
            $category2 = Specialization::whereHas('translations', function($q) use ($request) {
                $q->where('title', $request->category);
            })->first();

            $category3 = DoctorSpecialization::where('specialization_id', $category2->id)
                ->pluck('doctor_id')->toArray();

            $query->whereIn('id', $category3);
        }

        $doctors = $query->latest()->get();

        if ($request->ajax()) {
            return view('site.doctors.partials.doctors_list', compact('doctors'))->render();
        }

        $categories = Specialization::get();

        // if ($request->has('type') && in_array($request->type, $types)) {
        //     $categories = Doctor::where('type', $request->type)
        //         ->orWhere('type', DoctorCategoryType::BOTH->value)
        //         ->get();
        // }

        $page = Page::where('type', PageType::DOCTOR->value)
            ->with('translations')
            ->first();

        $url['ua'] = url('/') . '/ua/nashi-speczialisty';
        $url['ru'] = url('/') . '/nashi-speczialisty';
        $url['en'] = url('/') . '/en/nashi-speczialisty';

        return view('site.doctors.index', compact(
            'doctors',
            'categories',
            'page',
            'types',
            'url',
        ));
    }

    public function show(Doctor $doctor)
    {
        $page = Page::where('type', PageType::DOCTOR->value)
            ->with('translations')
            ->first();

        $service = resolve(MetaService::class);

        // $seo = $service->getMeta($page->title, $doctor->seo_title, $doctor->seo_description);
        $doctorPage = Page::where('type', PageType::ONEDOCTOR->value)
            ->with('translations')
            ->first();

        $seo = $service->getMeta($page->title, $doctorPage->meta_title, $doctorPage->meta_description);
        $seo[1] = strip_tags($seo[1]);

        $relatedArticles = Article::inrandomOrder()
            ->take(3)
            ->get();

        $reviews = $doctor->reviews;

        $url['ua'] = url('/') . '/ua/team-member/' . $doctor->slug;
        $url['ru'] = url('/') . '/team-member/' . $doctor->slug;
        $url['en'] = url('/') . '/en/team-member/' . $doctor->slug;

        return view('site.doctors.show', compact('doctor', 'page', 'seo', 'relatedArticles', 'reviews', 'url'));
    }

    public function getCategoriesByType(Request $request)
    {
        $type = $request->type;

        $categories = DoctorSpecialization::where('type', $type)->get();

        return response()->json($categories);
    }

    public function getDoctorsByCategory($categoryId)
    {
        $doctors = Doctor::where('specialization_id', $categoryId)->get(['id', 'name']);

        return response()->json($doctors);
    }
}
