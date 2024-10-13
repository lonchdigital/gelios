<?php

namespace App\Livewire\Admin\OneCenter;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use App\Models\BriefBlock;
use Livewire\WithPagination;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use App\Traits\Livewire\HandlesPageBlocks;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Livewire\OneCenter\HandlesSlider;
use App\Services\Admin\OneCenter\OneCenterService;
use App\Traits\Livewire\OneCenter\HandlesBriefBlocks;

class Edit extends Component
{
    use WithPagination, 
        WithFileUploads, 
        HandlesSlider,
        HandlesBriefBlocks,
        HandlesPageBlocks;

    public Page $page;
    public array $slides = [];
    public array $briefBlocks = [];
    public array $sectionOneData = [];
    public array $sectionTwoData = [];
    public array $seoData = [];

    protected OneCenterService $oneCenterService;
    
    public function mount() 
    {
        $this->oneCenterService = app(OneCenterService::class);
        $this->dispatch('livewire:load');
        
        $this->page = Page::where('type', PageType::ONECENTER->value)->first();

        // Set Slides
        $slides = BriefBlock::where('page_id', $this->page->id)->where('type', 'slider')->orderBy('sort', 'asc')->get();
        updateSort($slides);
        foreach($slides as $slide) {
            $title = [];
            $description = [];

            if(!is_null($slide)) {
                foreach ($slide->getTranslationsArray() as $lang => $value) {
                    $title[$lang] = $value['title'];
                }
                foreach ($slide->getTranslationsArray() as $lang => $value) {
                    $description[$lang] = $value['description'];
                }
            }

            $this->slides[] = [
                'id' => $slide->id,
                'sort' => $slide->sort,
                'oldImage' => $slide->image ?? '',
                'newImage' => null,
                'image' => $slide->image,
                'title' => $title,
                'description' => $description,
            ];
        }
        $this->slides = makeUsort($this->slides);

        // Set Brief blocks
        $briefBlocks = BriefBlock::where('page_id', $this->page->id)->where('type', 'briefBlocks')->orderBy('sort', 'asc')->get();
        updateSort($briefBlocks);
        foreach($briefBlocks as $briefBlock) {
            $title = [];

            if(!is_null($briefBlock)) {
                foreach ($briefBlock->getTranslationsArray() as $lang => $value) {
                    $title[$lang] = $value['title'];
                }
            }

            $this->briefBlocks[] = [
                'id' => $briefBlock->id,
                'sort' => $briefBlock->sort,
                'oldImage' => $briefBlock->image ?? '',
                'newImage' => null,
                'image' => $briefBlock->image,
                'title' => $title
            ];
        }
        $this->briefBlocks = makeUsort($this->briefBlocks);

        // set text block
        $pageTextBlock = PageTextBlock::where('number', 1)->where('page_id', $this->page->id)->first();
        $this->sectionOneData = $this->setPageTextBlock($pageTextBlock);
        
        
        // set text block
        $pageTextBlockTwo = PageTextBlock::where('number', 2)->where('page_id', $this->page->id)->first();
        $this->sectionTwoData = $this->setPageTextBlock($pageTextBlockTwo);

        // Set SEO data
        $this->seoData = $this->oneCenterService->setSeoData($this->page);
    }

    public function hydrate()
    {
        $this->oneCenterService = app(OneCenterService::class);
    }

    public function updated($propertyName)
    {
        if (preg_match('/slides\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForSlides($propertyName);
        }
        if (preg_match('/briefBlocks\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForBriefBlocks($propertyName);
        }
        if (preg_match('/sectionOneData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(1);
        }
        if (preg_match('/sectionTwoData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(2);
        }
        
    }


    protected function handleSectionImage(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['media']['temporaryImage'] = $this->sectionOneData['media']['newImage']->temporaryUrl();
                break;
            case 2:
                $this->sectionTwoData['media']['temporaryImage'] = $this->sectionTwoData['media']['newImage']->temporaryUrl();
                break;
        }
        
    }
    public function handleDisplayFields(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['is_image'] = $this->sectionOneData['is_image'];
                break;
            case 2:
                $this->sectionTwoData['is_image'] = $this->sectionTwoData['is_image'];
                break;
        }
    }
    public function deleteSectionImage(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['media']['image'] = null;
                $this->sectionOneData['media']['temporaryImage'] = null;
                break;
            case 2:
                $this->sectionTwoData['media']['image'] = null;
                $this->sectionTwoData['media']['temporaryImage'] = null;
                break;
        }
    }


    protected function rules()
    {
        return [
            'companiesRowOne.*.newImage' => [
                'nullable'
            ],
            'companiesRowTwo.*.newImage' => [
                'nullable'
            ],
        ];
    }

    public function save()
    {
        // $this->validate();

        $existingSlides = BriefBlock::where('page_id', $this->page->id)->where('type', 'slider')->get();
        $this->oneCenterService->syncSlides($this->slides, $existingSlides, $this->page->id);

        $existingBriefBlocks = BriefBlock::where('page_id', $this->page->id)->where('type', 'briefBlocks')->get();
        $this->oneCenterService->syncBriefBlocks($this->briefBlocks, $existingBriefBlocks, $this->page->id);

        $formData = [
            'image' => $this->sectionOneData['media'] ?? null,
            'text_one' => $this->sectionOneData['text_one'],
            'text_two' => $this->sectionOneData['text_two'],
            'is_reverse' => $this->sectionOneData['is_reverse'],
            'is_image' => $this->sectionOneData['is_image'],
        ];
        $this->updatePageTextBlock($formData, $this->page->id, 1);

        $formDataTwo = [
            'image' => $this->sectionTwoData['media'] ?? null,
            'text_one' => $this->sectionTwoData['text_one'],
            'text_two' => $this->sectionTwoData['text_two'],
            'is_reverse' => $this->sectionTwoData['is_reverse'],
            'is_image' => $this->sectionTwoData['is_image'],
        ];
        $this->updatePageTextBlock($formDataTwo, $this->page->id, 2);

        // Update Direction Page
        $this->oneCenterService->updatePage($this->page, $this->seoData);

        redirect()->route('one.center.show')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.one-center.edit');
    }

}
