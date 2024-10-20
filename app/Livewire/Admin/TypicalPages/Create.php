<?php

namespace App\Livewire\Admin\TypicalPages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\TypicalPages\TypicalPagesService;
use App\Traits\Livewire\TypicalPages\HandlesBriefBlocks;

class Create extends Component
{
    use WithFileUploads,
        SeoPages,
        HandlesBriefBlocks;

    public Page|null $page;
    public array $contentData = [];
    public array $briefBlocks = [];
    public array $seoData = [];

    protected TypicalPagesService $typicalPagesService;

    public function mount() 
    {
        $this->typicalPagesService = new TypicalPagesService;
        $this->dispatch('livewire:load');

    }

    public function hydrate()
    {
        $this->typicalPagesService = app(TypicalPagesService::class);
    }
    
    public function updated()
    {}

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

        $this->page = $this->typicalPagesService->createTypicalPage($this->contentData);

        $existingBriefBlocks = collect([]);
        $this->typicalPagesService->syncBriefBlocks($this->briefBlocks, $existingBriefBlocks, $this->page->id);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('typical.pages.edit', $this->page)->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.typical-pages.create');
    }

}