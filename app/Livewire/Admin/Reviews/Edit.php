<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Doctor;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Reviews\ReviewsService;


class Edit extends Component
{
    use WithFileUploads;

    public Review|null $review = null;

    public array $sectionData = [];

    public array $reviewDoctors = [];
    public array $reviewPages = [];
    public Collection $allPages;
    public Collection $allDoctos;

    public array $phones = [];
    public array $emails = [];

    protected ReviewsService $reviewsService;
    
    public function mount() 
    {
        $this->reviewsService = app(ReviewsService::class);
        $this->dispatch('livewire:load');

        $this->allPages = $this->reviewsService->getAllPages();
        $this->allDoctos = $this->reviewsService->getAlldoctors();

        $this->reviewDoctors = $this->reviewsService->setCurrentReviewDoctors($this->review);
        $this->reviewPages = $this->reviewsService->setCurrentReviewPages($this->review);

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
        $rules = [];

        $rules['sectionData.published'] = [
            'boolean'
        ];

        $rules['reviewDoctors'] = [
            'array'
        ];
        $rules['reviewPages'] = [
            'array'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['sectionData.name.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionData.text.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
        endforeach;

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $this->review = $this->reviewsService->updateReview($this->sectionData, $this->review);

        $this->review->doctors()->sync($this->reviewDoctors);
        $this->review->pages()->sync($this->reviewPages);

        if($this->sectionData['published']) {
            redirect()->route('reviews.index')->with('success', trans('admin.updated_review'));
        } else {
            redirect()->route('unpublished.reviews.index')->with('success', trans('admin.updated_review'));
        }
    }

    public function render()
    {
        return view('livewire.admin.reviews.edit');
    }

}
