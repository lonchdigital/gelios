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

        return view('site.pages.offices',[
            'page' => $page,
            'contacts' => Contact::all(),
        ]);
    }
}
