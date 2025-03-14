<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Contact;

class OfficesController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::OFFICES->value)->first();
        $url['ua'] = url('/') . '/ua/offices';
        $url['ru'] = url('/') . '/offices';
        $url['en'] = url('/') . '/en/offices';

        return view('site.pages.offices',[
            'page' => $page,
            'contacts' => Contact::all(),
            'url' => $url
        ]);
    }
}
