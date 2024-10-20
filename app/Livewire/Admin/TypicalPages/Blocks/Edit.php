<?php

namespace App\Livewire\Admin\TypicalPages\Blocks;

use App\Models\Page;
use Livewire\Component;
use App\Models\PageTextBlock;
use Livewire\WithFileUploads;
use App\Services\Admin\TypicalPages\TypicalPagesService;


class Edit extends Component
{
    use WithFileUploads;

    public Page $page;
    public PageTextBlock|null $pageTextBlock = null;
    public array $sectionData = [];

    protected TypicalPagesService $typicalPagesService;
    
    public function mount() 
    {
        $this->typicalPagesService = app(TypicalPagesService::class);
        $this->dispatch('livewire:load');

        // set text block
        $this->sectionData = $this->typicalPagesService->setTextBlockData($this->pageTextBlock);
    }

    public function hydrate()
    {
        $this->typicalPagesService = app(TypicalPagesService::class);
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

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();


        $formData = [
            'image' => $this->sectionData['media'] ?? null,
            'text_one' => $this->sectionData['text_one'],
            'text_two' => $this->sectionData['text_two'],
            'is_reverse' => $this->sectionData['is_reverse'],
            'is_image' => $this->sectionData['is_image'],
        ];
        $this->typicalPagesService->updateTextBlock($formData, $this->pageTextBlock, $this->page);

        redirect()->route('typical.pages.edit', ['page' => $this->page])->with('success', trans('admin.added_block_section'));
    }

    public function render()
    {
        return view('livewire.admin.typical-pages.blocks.edit', ['page' => $this->page]);
    }

}
