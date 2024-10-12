<?php

namespace App\Livewire\Admin\TextPages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\TextPages\TextPagesService;

class Edit extends Component
{
    use WithFileUploads, SeoPages;

    public Page $page;
    public array $contentData = [];
    public array $seoData = [];

    protected TextPagesService $textPagesService;

    public function mount() 
    {
        $this->textPagesService = new TextPagesService;
        $this->dispatch('livewire:load');

        $this->contentData = $this->textPagesService->setContentData($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->textPagesService = app(TextPagesService::class);
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

        $this->textPagesService->updateContentData($this->page, $this->contentData);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('text.pages.edit', $this->page)->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.text-pages.edit', ['page' => $this->page]);
    }

}