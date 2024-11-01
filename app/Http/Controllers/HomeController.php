<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use App\Models\Page;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function index()
    {
        $url['ua'] = url('/');
        $url['ru'] = url('/') . '/ru/';
        $url['en'] = url('/') . '/en/';

        $promotions = Promotion::inRandomOrder()->take(3)->get();
        $doctors = Doctor::mainPage()->get();
        $page = Page::where('type', PageType::MAINPAGE->value)
            ->with('translations', 'pageBlocks', 'pageBlocks.translations')
            ->first();

        return view('site.pages.main',[
            'insuranceCompanies' => InsuranceCompany::all(),
            'promotions' => $promotions,
            'doctors' => $doctors,
            'page' => $page,
        ]);
    }
}
