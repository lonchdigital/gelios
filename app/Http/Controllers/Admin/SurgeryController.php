<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Surgery;
use App\Models\SurgeryBlock;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    public function index()
    {
        $page = Page::where('type', PageType::SURGERY->value)
            ->first();
        
        return view('admin.surgery.index', compact('page'));
    }

    public function index2()
    {
        return view('admin.surgery.index2');
    }

    public function showSurgery(Surgery $surgery)
    {
        return view('admin.surgery.show', compact('surgery'));
    }

    public function edit(PageBlock $block)
    {
        return view('admin.surgery.edit', compact('block'));
    }

    public function createsurgery(Surgery $surgery)
    {
        return view('admin.surgery.direction.create', compact('surgery'));
    }

    public function editSurgery(Surgery $surgery)
    {
        return view('admin.surgery.direction.edit', compact('surgery'));
    }

    public function createSurgeryBlock(Surgery $surgery)
    {
        return view('admin.surgery.direction.create-block', compact('surgery'));
    }

    public function editSurgeryBlock(Surgery $surgery, SurgeryBlock $block)
    {
        return view('admin.surgery.direction.edit-block', compact('surgery', 'block'));
    }

    public function createStaticBlock(Page $page)
    {
        return view('admin.surgery.static-block.create-block', compact('page'));
    }

    public function editStaticBlock(Page $page, PageBlock $block)
    {
        return view('admin.surgery.static-block.edit-block', compact('page', 'block'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::SURGERY->value)
            ->first();

        return view('admin.surgery.main-page-seo', compact('page'));
    }

    public function createConditionsBlock(Page $page)
    {
        return view('admin.surgery.conditions.create', compact('page'));
    }

    public function editConditionsBlock(Page $page, PageBlock $block)
    {
        return view('admin.surgery.conditions.edit', compact('page', 'block'));
    }

    public function createInpatientBlock(Page $page)
    {
        return view('admin.surgery.inpatient.create', compact('page'));
    }

    public function editInpatientBlock(Page $page, PageBlock $block)
    {
        return view('admin.surgery.inpatient.edit', compact('page', 'block'));
    }
}
