<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\Site\ContactsService;

class ContactsController extends Controller
{

    private ContactsService $service;
    private Page $page;

    public function __construct(ContactsService $service)
    {
        $this->service = $service;
        $this->page = Page::where('type', PageType::CONTACTS->value)->first();
    }

    public function page()
    {
        $url['ua'] = url('/') . '/ua/contacts';
        $url['ru'] = url('/') . '/contacts';
        $url['en'] = url('/') . '/en/contacts';

        return view('site.pages.contacts',[
            'page' => $this->page,
            'url' => $url,
        ]);
    }

    public function searchFilter(Request $request): array
    {
        $request->validate([
            'query' => 'required|array'
        ]);

        return $this->service->getFilteredItems($request);
    }
}
