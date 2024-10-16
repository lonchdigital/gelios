<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Page;
use App\Models\Review;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Reviews\ReviewsService;

class Index extends Component
{
    use WithPagination, WithFileUploads, SeoPages;

    public Page $page;
    public array $sectionData = [];
    // public $reviews;

    public array $seoData = [];

    protected ReviewsService $reviewsService;


    public function mount()
    {
        $this->reviewsService = app(ReviewsService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::REVIEWS->value)->first();

        // $this->reviews = Review::paginate(10);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
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

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();


        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('reviews.index', $this->page)->with('success', trans('admin.document_updated'));
    }
    
    public function render()
    {
        $reviews = Review::paginate(10);

        return view('livewire.admin.reviews.index', ['reviews' => $reviews]);
    }
}