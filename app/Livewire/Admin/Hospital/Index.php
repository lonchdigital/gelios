<?php

namespace App\Livewire\Admin\Hospital;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\WithPagination;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Traits\Livewire\HandlesPageBlocks;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Livewire\HandlesSectionProgress;
use App\Services\Admin\Hospitals\HospitalsService;

class Index extends Component
{
    use WithPagination, 
        WithFileUploads, 
        HandlesPageBlocks,
        HandlesSectionProgress,
        SeoPages;

    public Page $page;
    public array $sectionData = [];
    public array $pageData = [];
    public array $sectionProgress = [];
    public Collection $hospitals;

    public array $seoData = [];

    protected HospitalsService $hospitalsService;


    public function mount()
    {
        $this->hospitalsService = app(HospitalsService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::HOSPITAL->value)->first();

        // set text block
        $pageTextBlock = PageTextBlock::where('number', 1)->where('page_id', $this->page->id)->first();
        $this->sectionData = $this->setPageTextBlock($pageTextBlock);

        $this->hospitals = Hospital::all();

        // set page data
        $this->pageData = $this->hospitalsService->setPageData($this->page);
        
        // set section Progress
        $this->sectionProgress = $this->setSectionProgress($this->page, 'main');

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->hospitalsService = app(HospitalsService::class);
    }

    public function updated($propertyName)
    {
        if (preg_match('/sectionData.media.newImage/', $propertyName)) {
            $this->sectionData['media']['temporaryImage'] = $this->sectionData['media']['newImage']->temporaryUrl();
        }
        if (preg_match('/sectionProgress.media.newImage/', $propertyName)) {
            $this->sectionProgress['media']['temporaryImage'] = $this->sectionProgress['media']['newImage']->temporaryUrl();
        }
    }

    public function handleDisplayFields()
    {
        $this->sectionData['is_image'] = $this->sectionData['is_image'];
    }
    public function deleteSectionImage()
    {
        $this->sectionData['media']['image'] = null;
        $this->sectionData['media']['temporaryImage'] = null;
    }

    public function removeHospitalFromDB(int $hospitalID)
    {
        $this->hospitalsService->removeHospital($hospitalID);

        redirect()->route('hospitals.index')->with('success', trans('admin.deleted_hospital_stationary'));
    }

    protected function rules()
    {
        $rules = [];

        $rules['sectionData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionData.is_image'] = [
            'boolean'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['pageData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['pageData.sub_title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionProgress.first.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.first.description.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.second.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.second.description.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.third.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.third.description.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.fourth.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['sectionProgress.fourth.description.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionData.text_two.' . $locale] = [
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

        // dd('stop', $this->sectionProgress);

        $this->updateSectionProgress($this->sectionProgress, $this->page->id, 'main');


        $formData = [
            'image' => $this->sectionData['media'] ?? null,
            'text_one' => $this->sectionData['text_one'],
            'text_two' => $this->sectionData['text_two'],
            'is_reverse' => $this->sectionData['is_reverse'],
            'is_image' => $this->sectionData['is_image'],
        ];
        $this->updatePageTextBlock($formData, $this->page->id, 1);

        // Update Page
        $this->hospitalsService->updatePageData($this->page, $this->pageData);

        // Update SEO Page
        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('hospitals.index')->with('success', trans('admin.document_updated'));
    }
    
    public function render()
    {
        return view('livewire.admin.hospital.index');
    }
}