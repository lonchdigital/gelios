<?php

namespace App\Livewire\Admin\InsuranceCompanies;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Models\PageContactItem;
use App\Traits\Livewire\SeoPages;
use App\Traits\Livewire\HandlesPageBlocks;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\InsuranceCompanies\InsuranceCompaniesService;
use App\Traits\Livewire\Contacts\HandlesPhones;

class InsuranceCompaniesPage extends Component
{
    use WithPagination, WithFileUploads, SeoPages, HandlesPageBlocks, HandlesPhones;

    public Page $page;

    public array $pageData = [];
    public array $textBlockOneData = [];

    public array $phones = [];

    public array $seoData = [];

    protected InsuranceCompaniesService $insuranceCompaniesService;

    public function mount() 
    {
        $this->insuranceCompaniesService = new InsuranceCompaniesService;
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::INSURANCECOMPANIES->value)->first();

        // Set Section One data
        $textBlockOne = PageTextBlock::where('number', 1)->where('page_id', $this->page->id)->first();
        $this->textBlockOneData = $this->setPageTextBlock($textBlockOne);

        // Set phones
        $phones = PageContactItem::where('page_id', $this->page->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
        updateSort($phones);
        foreach($phones as $phone) {
            $this->phones[] = [
                'id' => $phone->id,
                'sort' => $phone->sort,
                'type' => $phone->type,
                'item' => $phone->item
            ];
        }
        $this->phones = makeUsort($this->phones);

        // set page data
        $this->pageData = $this->insuranceCompaniesService->setPageData($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->insuranceCompaniesService = app(InsuranceCompaniesService::class);
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


        $rules['phones.*.item'] = [
            'required',
            'string',
        ];


        foreach (config('translatable.locales') as $locale):
            $rules['pageData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['textBlockOneData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            
            $rules['pageData.description.' . $locale] = [
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

        $this->insuranceCompaniesService->updatePageData($this->page, $this->pageData);

        // TOP section
        $formData = [
            'image' => $this->textBlockOneData['media'] ?? null,
            'text_one' => $this->textBlockOneData['text_one'],
            'text_two' => null,
            'is_reverse' => false,
            'is_image' => true,
        ];
        $this->updatePageTextBlock($formData, $this->page->id, 1);

        // BOTTOM section
        $existingPhones = PageContactItem::where('page_id', $this->page->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
        $this->insuranceCompaniesService->syncItems($this->phones, $existingPhones, $this->page->id, 'phone');

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('insurance.companies.page.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.insurance-companies.insurance-companies-page', ['page' => $this->page]);
    }

}