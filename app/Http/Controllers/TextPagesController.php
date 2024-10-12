<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Direction;
use App\Http\Controllers\Controller;

class TextPagesController extends Controller
{

    public function show(Page $page)
    {
        if( $page->type !== "text" ) { abort(404); }

        return view('site.text-pages.show', [
            'page' => $page
        ]);
    }

}
