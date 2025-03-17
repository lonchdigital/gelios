<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::active()->get();

        $page = Page::where('type', PageType::OPENING)
            ->with('pageBlocks', 'pageBlocks.translations')
            ->firstOrFail();

        $url['ua'] = url('/') . '/ua/vakansii';
        $url['ru'] = url('/') . '/vakansii';
        $url['en'] = url('/') . '/en/vakansii';

        return view('site.vacancy.index', compact('vacancies', 'page', 'url'));
    }
}
