<?php

namespace App\Livewire\Admin\Directions;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use App\Models\BriefBlock;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\Directions\DirectionsService;
use App\Services\Admin\CommonBlocksService;

class DirectionsPage extends Component
{
    use WithFileUploads, SeoPages;

    public Page $page;
    public array $sectionData = [];
    public array $seoData = [];
    protected DirectionsService $directionsService;

    public array $contentData = [];
    protected CommonBlocksService $commonBlocksService;

    public function mount() 
    {
        $this->directionsService = new DirectionsService;
        $this->commonBlocksService = new CommonBlocksService;
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::DIRECTIONS->value)->first();

        // set page data
        $this->sectionData = $this->directionsService->setMainDirectionPage($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);


        $directionsData = BriefBlock::where('type', 'directions')->first();
        $this->contentData = $this->commonBlocksService->setDirectionsData($directionsData);
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
        $this->commonBlocksService = app(CommonBlocksService::class);
    }
    
    public function updated()
    {}

    protected function rules()
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale):
            $rules['sectionData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
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

            $rules['contentData.title.' . $locale] = [
                'required',
                'string',
                'max:255'
            ];
            $rules['contentData.description.' . $locale] = [
                'nullable',
                'string',
            ];
        endforeach;

        return $rules;
    }

    protected function attributes()
    {
        $attributes = [];

        foreach (config('translatable.locales') as $locale) {
            $attributes['contentData.title.' . $locale] = trans('admin.title') . ' ('. $locale .')';
            $attributes['contentData.description.' . $locale] = trans('admin.description') . ' ('. $locale .')';
        }

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    public function save()
    {
        $this->validate();

        $this->directionsService->updateMainDirectionPage($this->page, $this->sectionData);
        $this->updateSeoDataPage($this->page, $this->seoData);

        $briefBlock = BriefBlock::where('type', 'directions')->first();
        $this->commonBlocksService->updateDirectionsData($briefBlock, $this->contentData);

        redirect()->route('directions.page.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.directions-page', ['page' => $this->page]);
    }

}