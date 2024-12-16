<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\PageTextBlock;
use App\Models\PageContactItem;
use App\Models\InsuranceCompany;

class InsuranceCompaniesController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::INSURANCECOMPANIES->value)->first();
        $pageTextBlock = PageTextBlock::where('number', 1)->where('page_id', $page->id)->first();

        return view('site.pages.insurance-companies', [
            'page' => $page,
            'pageTextBlock' => $pageTextBlock,
            'companiesRowOne' => InsuranceCompany::where('row', 1)->orderBy('sort', 'asc')->get(),
            'companiesRowTwo' => InsuranceCompany::where('row', 2)->orderBy('sort', 'asc')->get(),
            'phones' => PageContactItem::where('page_id', $page->id)->where('type', 'phone')->orderBy('sort', 'asc')->get()
        ]);
    }
}
