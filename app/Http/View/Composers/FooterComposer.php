<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use App\Enums\PageType;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view)
    {
        $view->with('footerPages', Page::where('type', PageType::TEXT->value)->where('show_in_footer', 1)->get());
    }
}
