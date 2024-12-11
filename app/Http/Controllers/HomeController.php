<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Models\Review;
use App\Enums\PageType;
use App\Models\Contact;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;

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
            'contacts' => Contact::all(),
            'page' => $page,
            'reviews' => Review::where('published', true)->latest()->limit(10)->get()
        ]);
    }
}
