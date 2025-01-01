<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Traits\Livewire\HandlesPageBlocks;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Reviews\ReviewsService;

class ReviewsPage extends Component
{
    use WithPagination, WithFileUploads, SeoPages, HandlesPageBlocks;

    public Page $page;

    public array $sectionData = [];
    public array $textBlockOneData = [];

    public array $seoData = [];

    protected ReviewsService $reviewsService;

    public function mount() 
    {
        $this->reviewsService = new ReviewsService;
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::REVIEWS->value)->first();

        // set page data
        $this->sectionData = $this->reviewsService->setPageData($this->page);

        // Set Section One data
        $textBlockOne = PageTextBlock::where('number', 1)->where('page_id', $this->page->id)->first();
        $this->textBlockOneData = $this->setPageTextBlock($textBlockOne);
        
        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->reviewsService = app(ReviewsService::class);
    }
    
    public function updated($propertyName)
    {
        if (preg_match('/textBlockOneData.media.newImage/', $propertyName)) {
            $this->handleSectionImage();
        }
    }

    protected function handleSectionImage()
    {
        $this->textBlockOneData['media']['temporaryImage'] = $this->textBlockOneData['media']['newImage']->temporaryUrl();
        
    }
    public function handleDisplayFields()
    {
        $this->textBlockOneData['is_image'] = $this->textBlockOneData['is_image'];
    }
    public function deleteSectionImage()
    {
        $this->textBlockOneData['media']['image'] = null;
        $this->textBlockOneData['media']['temporaryImage'] = null;
    }

    protected function rules()
    {
        $rules = [];

        $rules['textBlockOneData.is_reverse'] = [
            'boolean'
        ];
        $rules['textBlockOneData.is_image'] = [
            'boolean'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['sectionData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['textBlockOneData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['textBlockOneData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];

            // seo
            $rules['seoData.meta_title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['seoData.meta_description.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['seoData.meta_keywords.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['seoData.seo_title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['seoData.seo_text.' . $locale] = [
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

        $this->reviewsService->updatePageData($this->page, $this->sectionData);

        $formData = [
            'image' => $this->textBlockOneData['media'] ?? null,
            'text_one' => $this->textBlockOneData['text_one'],
            'text_two' => $this->textBlockOneData['text_two'],
            'is_reverse' => $this->textBlockOneData['is_reverse'],
            'is_image' => $this->textBlockOneData['is_image'],
        ];
        $this->updatePageTextBlock($formData, $this->page->id, 1);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('reviews.page.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.reviews.reviews-page', ['page' => $this->page]);
    }

}