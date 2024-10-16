<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Review;
use Livewire\Component;
use App\Models\ContactItem;
use Livewire\WithFileUploads;
use App\Services\Admin\Reviews\ReviewsService;


class Edit extends Component
{
    use WithFileUploads;

    public Review|null $review = null;

    public array $sectionData = [];
    public array $phones = [];
    public array $emails = [];

    protected ReviewsService $reviewsService;
    
    public function mount() 
    {
        $this->reviewsService = app(ReviewsService::class);
        $this->dispatch('livewire:load');

        $this->sectionData = $this->reviewsService->setReviewData($this->review);
    }

    public function hydrate()
    {
        $this->reviewsService = app(ReviewsService::class);
    }


    public function updated($propertyName)
    {
        if (preg_match('/sectionData.media.newImage/', $propertyName)) {
            $this->handleReviewImage();
        }
    }
    protected function handleReviewImage()
    {
        $this->sectionData['media']['temporaryImage'] = $this->sectionData['media']['newImage']->temporaryUrl();
    }
    public function deleteReviewImage()
    {
        $this->sectionData['media']['image'] = null;
        $this->sectionData['media']['temporaryImage'] = null;
    }


    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();
        
        $currentContact = $this->reviewsService->updateReview($this->sectionData, $this->review);

        redirect()->route('reviews.index')->with('success', trans('admin.added_review'));
    }

    public function render()
    {
        return view('livewire.admin.reviews.edit');
    }

}
