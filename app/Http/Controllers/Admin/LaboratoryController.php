<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use App\Models\Page;
use App\Models\PageBlock;
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

    public function createSlide(Page $page)
    {
        return view('admin.laboratory.slider.create', compact('page'));
    }

    public function editSlide(Page $page, PageBlock $block)
    {
        return view('admin.laboratory.slider.edit', compact('page', 'block'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::LABORATORY->value)
            ->first();

        return view('admin.laboratory.main-page-seo', compact('page'));
    }

    public function onePageSeo()
    {
        $page = Page::where('type', PageType::ONELABORATORY->value)
            ->first();

        return view('admin.laboratory.one-page-seo', compact('page'));
    }
}
