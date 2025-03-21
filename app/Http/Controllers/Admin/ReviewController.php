<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function page()
    {
        return view('admin.reviews.page');
    }

    public function index()
    {
        return view('admin.reviews.index');
    }

    public function index2()
    {
        return view('admin.reviews.index2');
    }

    public function unpublishedIndex()
    {
        return view('admin.reviews.unpublished-index');
    }

    public function createReview()
    {
        $review = null;
        return view('admin.reviews.edit', compact('review'));
    }
    public function editReview(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

}
