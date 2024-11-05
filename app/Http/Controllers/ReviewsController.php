<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Models\Review;
use App\Enums\PageType;
use App\Models\BriefBlock;
use App\Models\SectionImage;
use App\Models\PageTextBlock;
use App\Models\PageMediaBlock;

class ReviewsController extends Controller
{
    public function page()
    {
        $page = Page::where('type', PageType::REVIEWS->value)->first();

        return view('site.pages.reviews',[
            'page' => $page,
            'reviews' => Review::latest()->paginate(8)
        ]);
    }
}
