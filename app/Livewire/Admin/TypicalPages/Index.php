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

class Index extends Component
{
    use WithFileUploads;

    public Collection $pages;

    protected TypicalPagesService $typicalPagesService;

    public function mount() 
    {
        $this->typicalPagesService = new TypicalPagesService;

    }

    public function hydrate()
    {
        $this->typicalPagesService = app(TypicalPagesService::class);
    }
    
    public function updated()
    {}

    public function removeTypicalPageFromDB($id)
    {
        $this->typicalPagesService->removeTypicalPage($id);

        redirect()->route('typical.pages.index')->with('success', trans('admin.page_deleted'));
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

    public function render()
    {
        return view('livewire.admin.typical-pages.index');
    }

}