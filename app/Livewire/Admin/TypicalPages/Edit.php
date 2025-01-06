<?php

namespace App\Livewire\Admin\TypicalPages;

use App\Models\Page;
use Livewire\Component;
use App\Models\BriefBlock;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\TypicalPages\TypicalPagesService;
use App\Traits\Livewire\TypicalPages\HandlesBriefBlocks;
use Illuminate\Database\Eloquent\Collection;

class Edit extends Component
{
    use WithFileUploads, 
        SeoPages,
        HandlesBriefBlocks;

    public Page $page;
    public array $briefBlocks = [];
    public array $contentData = [];
    public array $seoData = [];
    public Collection $pageTextBlocks;

    protected TypicalPagesService $typicalPagesService;

    public function mount() 
    {
        $this->typicalPagesService = new TypicalPagesService;
        $this->dispatch('livewire:load');

        // Set page data
        $this->contentData = $this->typicalPagesService->setContentData($this->page);

        // Set Page Text Blocks
        $this->pageTextBlocks = PageTextBlock::where('page_id', $this->page->id)->get();

        // Set Brief blocks
        $briefBlocks = BriefBlock::where('page_id', $this->page->id)->orderBy('sort', 'asc')->get();
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
                'title' => $title,
                'description' => $description,
            ];
        }
        $this->briefBlocks = makeUsort($this->briefBlocks);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->typicalPagesService = app(TypicalPagesService::class);
    }
    
    public function updated()
    {}

    public function removePageTextBlockFromDB($id)
    {
        $this->typicalPagesService->removePageTextBlock($id);
    }

    protected function rules()
    {
        return [
            'directionName.ua' => [
                'required',
                'string'
                // 'nullable'
            ],
            'directionTemplate' => [
                'required',
                'integer'
            ],
        ];
    }

    public function save()
    {
        // $this->validate();

        $this->typicalPagesService->updateTypicalPage($this->contentData, $this->page);

        $existingBriefBlocks = BriefBlock::where('page_id', $this->page->id)->get();
        $this->typicalPagesService->syncBriefBlocks($this->briefBlocks, $existingBriefBlocks, $this->page->id);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('typical.pages.edit', $this->page)->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.typical-pages.edit', ['page' => $this->page]);
    }

}