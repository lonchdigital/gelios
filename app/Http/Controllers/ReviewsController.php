<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Review;
use App\Enums\PageType;
use Illuminate\Http\Request;
use App\Services\Site\ReviewsService;
use Illuminate\Support\Facades\App;

class ReviewsController extends Controller
{

    private ReviewsService $service;
    private Page $page;

    public function __construct(ReviewsService $service)
    {
        $this->service = $service;
        $this->page = Page::where('type', PageType::REVIEWS->value)->first();
    }

    public function page()
    {
        $url['ua'] = url('/') . '/ua/otzyvy';
        $url['ru'] = url('/') . '/otzyvy';
        $url['en'] = url('/') . '/en/otzyvy';

        return view('site.pages.reviews',[
            'page' => $this->page,
            'reviews' => Review::where('published', true)->latest()->paginate(8),
            'url' => $url,
        ]);
    }

    public function userWriteReview(Request $request) : bool
    {
        $usersLocale = $request->input('locale');
        App::setLocale($usersLocale);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,|max:10240',
            'name' => 'required|string|max:100',
            'review' => 'required|string|max:300',
            'locale' => 'required|string|max:10'
        ]);

        return $this->service->saveUserReviewToDB($request->all(), $usersLocale);
    }
}
