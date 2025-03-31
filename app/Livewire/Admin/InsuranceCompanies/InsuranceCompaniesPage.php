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
use App\Models\InsuranceCompany;
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

    public array $companiesRowOne = [];
    public array $companiesRowTwo = [];

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

        // Insurance Companies rows
        $companiesRowOne = InsuranceCompany::where('row', 1)->orderBy('sort', 'asc')->get();
        $companiesRowTwo = InsuranceCompany::where('row', 2)->orderBy('sort', 'asc')->get();
        
        foreach($companiesRowOne as $companyRowOneItem) {
            $this->companiesRowOne[] = [
                'id' => $companyRowOneItem->id,
                'sort' => $companyRowOneItem->sort,
                'oldImage' => $companyRowOneItem->image ?? '',
                'newImage' => null,
                'image' => $companyRowOneItem->image
            ];
        }
        foreach($companiesRowTwo as $companyRowTwoItem) {
            $this->companiesRowTwo[] = [
                'id' => $companyRowTwoItem->id,
                'sort' => $companyRowTwoItem->sort,
                'oldImage' => $companyRowTwoItem->image ?? '',
                'newImage' => null,
                'image' => $companyRowTwoItem->image,
            ];
        }
        
        $this->companiesRowOne = makeUsort($this->companiesRowOne);
        $this->companiesRowTwo = makeUsort($this->companiesRowTwo);
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

        if (preg_match('/companiesRowOne\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForRowOne($propertyName);
        }
        if (preg_match('/companiesRowTwo\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForRowTwo($propertyName);
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

    protected function handleImageChangeForRowOne($propertyName)
    {
        preg_match('/companiesRowOne\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->companiesRowOne[$index]['temporaryImage'] = $this->companiesRowOne[$index]['newImage']->temporaryUrl();
    }
    protected function handleImageChangeForRowTwo($propertyName)
    {
        preg_match('/companiesRowTwo\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->companiesRowTwo[$index]['temporaryImage'] = $this->companiesRowTwo[$index]['newImage']->temporaryUrl();
    }

    public function deleteImageRowOne($index)
    {
        $this->companiesRowOne[$index]['image'] = null;
        $this->companiesRowOne[$index]['temporaryImage'] = null;
    }
    public function deleteImageRowTwo($index)
    {
        $this->companiesRowTwo[$index]['image'] = null;
        $this->companiesRowTwo[$index]['temporaryImage'] = null;
    }

    public function removeElementRowOne($index)
    {
        foreach($this->companiesRowOne as $index2 => $companyRowOne) {
            if($companyRowOne['sort'] > $this->companiesRowOne[$index]['sort']) {
                $this->companiesRowOne[$index2]['sort'] = $companyRowOne['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->companiesRowOne)) {
            unset($this->companiesRowOne[$index]);
        }
    }
    public function removeElementRowTwo($index)
    {
        foreach($this->companiesRowTwo as $index2 => $companyRowTwo) {
            if($companyRowTwo['sort'] > $this->companiesRowTwo[$index]['sort']) {
                $this->companiesRowTwo[$index2]['sort'] = $companyRowTwo['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->companiesRowTwo)) {
            unset($this->companiesRowTwo[$index]);
        }
    }

    public function addElementRowOne()
    {
        $this->companiesRowOne[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->companiesRowOne) + 1,
        ];
    }
    public function addElementRowTwo()
    {
        $this->companiesRowTwo[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->companiesRowTwo) + 1,
        ];
    }

    public function newPositionRowOne($val, $index)
    {
        $this->companiesRowOne[$index + $val]['sort'] = $this->companiesRowOne[$index]['sort'];

        $this->companiesRowOne[$index]['sort'] = $this->companiesRowOne[$index]['sort'] + $val;

        $this->companiesRowOne = makeUsort($this->companiesRowOne);
    }
    public function newPositionRowTwo($val, $index)
    {
        $this->companiesRowTwo[$index + $val]['sort'] = $this->companiesRowTwo[$index]['sort'];

        $this->companiesRowTwo[$index]['sort'] = $this->companiesRowTwo[$index]['sort'] + $val;

        $this->companiesRowTwo = makeUsort($this->companiesRowTwo);
    }

    protected function rules()
    {
        $rules = [];


        $rules['phones.*.item'] = [
            'required',
            'string',
        ];

        $rules['companiesRowOne.*.newImage'] = [
            'nullable'
        ];
        $rules['companiesRowTwo.*.newImage'] = [
            'nullable'
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

        $existingCompaniesRowOne = InsuranceCompany::where('row', 1)->get();
        $existingCompaniesRowTwo = InsuranceCompany::where('row', 2)->get();
        $this->insuranceCompaniesService->syncCompanies($this->companiesRowOne, $existingCompaniesRowOne, 1);
        $this->insuranceCompaniesService->syncCompanies($this->companiesRowTwo, $existingCompaniesRowTwo, 2);

        redirect()->route('insurance.companies.page.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.insurance-companies.insurance-companies-page', ['page' => $this->page]);
    }

}