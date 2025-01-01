<?php

namespace App\Livewire\Admin\Directions;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\Directions\DirectionsService;

class DirectionsPage extends Component
{
    use WithFileUploads, SeoPages;

    public Page $page;
    public array $sectionData = [];
    public array $seoData = [];

    protected DirectionsService $directionsService;

    public function mount() 
    {
        $this->directionsService = new DirectionsService;
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::DIRECTIONS->value)->first();

        // set page data
        $this->sectionData = $this->directionsService->setMainDirectionPage($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
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
        endforeach;

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $this->directionsService->updateMainDirectionPage($this->page, $this->sectionData);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('directions.page.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.directions-page', ['page' => $this->page]);
    }

}