<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Enums\PageType;
use App\Models\BriefBlock;
use App\Models\Contact;
use App\Models\SectionImage;
use App\Models\PageTextBlock;
use App\Models\PageMediaBlock;

class ContactsController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::CONTACTS->value)->first();

        return view('site.pages.contacts',[
            'page' => $page,
            'contacts' => Contact::all(),
        ]);
    }
}
