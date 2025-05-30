<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\Reviews\ReviewsService;

class Index extends Component
{
    use WithPagination;

    protected ReviewsService $reviewsService;


    public function mount()
    {

    }

    public function hydrate()
    {
        $this->reviewsService = app(ReviewsService::class);
    }

    public function removeReviewFromDB(int $reviewID)
    {
        $this->reviewsService->removeReview($reviewID);

        redirect()->route('reviews.index')->with('success', trans('admin.deleted_review'));
    }
    
    public function render()
    {
        $reviews = Review::where('published', true)->paginate(10);

        return view('livewire.admin.reviews.index', ['reviews' => $reviews]);
    }
}