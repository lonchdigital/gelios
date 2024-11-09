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
use App\Services\Admin\Hospitals\HospitalsService;

class Index extends Component
{
    use WithPagination, WithFileUploads, HandlesPageBlocks, SeoPages;

    public Page $page;
    public array $sectionData = [];
    public array $pageData = [];
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
            $this->handleSectionImage();
        }
    }

    protected function handleSectionImage()
    {
        $this->sectionData['media']['temporaryImage'] = $this->sectionData['media']['newImage']->temporaryUrl();
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
        return [

        ];
    }

    public function save()
    {
        // $this->validate();

        $this->hospitalsService->updatePageData($this->page, $this->pageData);


        $formData = [
            'image' => $this->sectionData['media'] ?? null,
            'text_one' => $this->sectionData['text_one'],
            'text_two' => $this->sectionData['text_two'],
            'is_reverse' => $this->sectionData['is_reverse'],
            'is_image' => $this->sectionData['is_image'],
        ];
        $this->updatePageTextBlock($formData, $this->page->id, 1);


        // Update SEO Page
        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('hospitals.index')->with('success', trans('admin.document_updated'));
    }
    
    public function render()
    {
        return view('livewire.admin.hospital.index');
    }
}