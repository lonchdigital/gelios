<?php

namespace App\Livewire\Admin\AboutUs;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use App\Models\BriefBlock;
use App\Models\SectionImage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PageMediaBlock;
use App\Traits\Livewire\SeoPages;
use App\Traits\Livewire\HandlesPageBlocks;
use App\Services\Admin\AboutUs\AboutUsService;
use App\Traits\Livewire\AboutUs\HandlesPhotos;
use App\Traits\Livewire\AboutUs\HandlesBriefBlocks;
use App\Traits\Livewire\AboutUs\HandlesCertificates;

class Edit extends Component
{
    use WithPagination, 
        WithFileUploads, 
        HandlesBriefBlocks, 
        HandlesPageBlocks, 
        HandlesCertificates,
        HandlesPhotos,
        SeoPages;

    public Page $page;

    public array $pageData = [];
    public array $seoData = [];

    public array $briefBlocks = [];
    public array $sectionData = [];
    public array $сertificates = [];
    public array $photos = [];

    protected AboutUsService $aboutUsService;
    
    public function mount() 
    {
        $this->aboutUsService = app(AboutUsService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::ABOUT->value)->first();

        // Set page data
        $this->pageData = $this->aboutUsService->setPageData($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);

        // Set Brief blocks
        $briefBlocks = BriefBlock::where('page_id', $this->page->id)->orderBy('sort', 'asc')->get();
        
        updateSort($briefBlocks);
        foreach($briefBlocks as $briefBlock) {
            $title = [];
            $description = [];

            if(!is_null($briefBlock)) {
                foreach ($briefBlock->getTranslationsArray() as $lang => $value) {
                    $title[$lang] = $value['title'];
                }
                foreach ($briefBlock->getTranslationsArray() as $lang => $value) {
                    $description[$lang] = $value['description'];
                }
            }

            $this->briefBlocks[] = [
                'id' => $briefBlock->id,
                'sort' => $briefBlock->sort,
                'oldImage' => $briefBlock->image ?? '',
                'newImage' => null,
                'image' => $briefBlock->image,
                'title' => $title,
                'description' => $description,
            ];
        }
        $this->briefBlocks = makeUsort($this->briefBlocks);

        // set media block
        $pageMediaBlock = PageMediaBlock::where('number', 1)->where('page_id', $this->page->id)->first();
        $this->sectionData = $this->setPageMediaBlock($pageMediaBlock);

        // Set Certificates
        $сertificates = SectionImage::where('page_id', $this->page->id)->where('type', 'сertificates')->orderBy('sort', 'asc')->get();
        updateSort($сertificates);
        foreach($сertificates as $сertificate) {
            $this->сertificates[] = [
                'id' => $сertificate->id,
                'sort' => $сertificate->sort,
                'oldImage' => $сertificate->image ?? '',
                'newImage' => null,
                'image' => $сertificate->image
            ];
        }
        $this->сertificates = makeUsort($this->сertificates);


        // Set Photos
        $photos = SectionImage::where('page_id', $this->page->id)->where('type', 'photos')->orderBy('sort', 'asc')->get();
        updateSort($photos);
        foreach($photos as $photo) {
            $this->photos[] = [
                'id' => $photo->id,
                'sort' => $photo->sort,
                'oldImage' => $photo->image ?? '',
                'newImage' => null,
                'image' => $photo->image
            ];
        }
        $this->photos = makeUsort($this->photos);
    }

    public function hydrate()
    {
        $this->aboutUsService = app(AboutUsService::class);
    }

    
    public function updated($propertyName)
    {
        if (preg_match('/briefBlocks\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForBriefBlocks($propertyName);
        }
        if (preg_match('/сertificates\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForCertificates($propertyName);
        }
        if (preg_match('/photos\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForPhotos($propertyName);
        }
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

    protected function rules()
    {
        $rules = [];
        
        $rules['briefBlocks'] = [
            'array'
        ];
        $rules['сertificates'] = [
            'array'
        ];
        $rules['photos'] = [
            'array'
        ];

        $rules['sectionData.video'] = [
            'nullable',
            'string',
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['pageData.title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionData.text.' . $locale] = [
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

        $this->aboutUsService->updatePageData($this->page, $this->pageData);

        $this->updateSeoDataPage($this->page, $this->seoData);

        $existingBriefBlocks = BriefBlock::where('page_id', $this->page->id)->get();
        $this->aboutUsService->syncBriefBlocks($this->briefBlocks, $existingBriefBlocks, $this->page->id);

        $formData = [
            'image' => $this->sectionData['media'] ?? null,
            'text' => $this->sectionData['text'],
            'is_reverse' => $this->sectionData['is_reverse'],
            // 'is_image' => $this->sectionData['is_image'],
            'is_image' => false,
            'video' => $this->sectionData['video'],
        ];
        $this->updatePageMediaBlock($formData, $this->page->id, 1);

        $existingCertificates = SectionImage::where('page_id', $this->page->id)->where('type', 'сertificates')->get();
        $this->aboutUsService->syncSectionImages($this->сertificates, $existingCertificates, $this->page->id, 'сertificates');
        
        $existingPhotos = SectionImage::where('page_id', $this->page->id)->where('type', 'photos')->get();
        $this->aboutUsService->syncSectionImages($this->photos, $existingPhotos, $this->page->id, 'photos');

        redirect()->route('about.us.edit')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.about-us.edit');
    }

}
