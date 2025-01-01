<?php

namespace App\Livewire\Admin\OneCenter;

use App\Models\Page;
use Livewire\Component;
use App\Models\BriefBlock;
use Livewire\WithPagination;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Traits\Livewire\HandlesPageBlocks;
use App\Traits\Livewire\OneCenter\HandlesSlider;
use App\Services\Admin\OneCenter\OneCenterService;
use App\Traits\Livewire\OneCenter\HandlesBriefBlocks;

class Edit extends Component
{
    use WithPagination, 
        WithFileUploads, 
        HandlesSlider,
        HandlesBriefBlocks,
        HandlesPageBlocks,
        SeoPages;

    public Page|null $page = null;
    public array $slides = [];
    public array $briefBlocks = [];
    public array $sectionOneData = [];
    public array $sectionTwoData = [];
    public array $pageData = [];
    public array $seoData = [];

    protected OneCenterService $oneCenterService;
    
    public function mount() 
    {
        $this->oneCenterService = app(OneCenterService::class);
        $this->dispatch('livewire:load');

        $this->page = $this->page;

        if( !is_null($this->page) ) {
            
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
                    'url' => $briefBlock->url ?? '',
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

            // Set page data
            $this->pageData = $this->oneCenterService->setPageData($this->page);

            // Set SEO data
            $this->seoData = $this->setSeoDataPage($this->page);

        } else {
            $this->sectionOneData = $this->setPageTextBlock(null);
            $this->sectionTwoData = $this->setPageTextBlock(null);

            $this->pageData = $this->oneCenterService->setPageData(null);
            $this->seoData = $this->setSeoDataPage(null);
        }

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
        $rules = [];

        $rules['pageData.slug'] = [
            'required',
            'string',
            'unique:pages,slug,' . ($this->page->id ?? ''),
            'unique:page_directions,slug'
        ];

        $rules['pageData.video_file'] = [
            'nullable',
            // 'file',
            'max:51200',
        ];

        $rules['sectionOneData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionOneData.is_image'] = [
            'boolean'
        ];
        $rules['sectionTwoData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionTwoData.is_image'] = [
            'boolean'
        ];

        $rules['slides'] = [
            'array'
        ];
        $rules['briefBlocks'] = [
            'array'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['pageData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionOneData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionOneData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionTwoData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionTwoData.text_two.' . $locale] = [
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

    protected function attributes()
    {
        $attributes = [];

        $attributes['pageData.slug'] = 'slug';

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    // public function updatedPageDataVideoFile()
    // {
    //     $this->validateOnly('pageData.video_file', [
    //         'pageData.video_file' => 'nullable|file|max:51200', // до 50MB
    //     ]);
    // }

    public function save()
    {
        $this->validate();

        // dd($this->sectionOneData, $this->sectionTwoData, $this->page->id);

        if( !is_null($this->page) ) {
            $this->oneCenterService->updatePageData($this->page, $this->pageData);
        } else {
            $this->page = $this->oneCenterService->createPage($this->pageData);
        }

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

        // dd($formData, $formDataTwo);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('one.center.edit', ['page' => $this->page])->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.one-center.edit');
    }

}
