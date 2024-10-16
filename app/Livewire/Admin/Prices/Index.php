<?php

namespace App\Livewire\Admin\Prices;

use App\Models\Page;
use App\Models\Test;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use App\Services\Admin\Prices\PricesService;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component
{
    use WithPagination, WithFileUploads, SeoPages;

    public Page $page;
    public array $sectionData = [];
    public Collection $tests;

    public array $seoData = [];

    protected PricesService $pricesService;


    public function mount()
    {
        $this->pricesService = app(PricesService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::PRICES->value)->first();

        $this->tests = Test::all();

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->pricesService = app(PricesService::class);
    }

    public function removeTestFromDB(int $testID)
    {
        $this->pricesService->removeTest($testID);

        redirect()->route('prices.index')->with('success', trans('admin.deleted_hospital_stationary'));
    }

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();




        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('prices.index', $this->page)->with('success', trans('admin.document_updated'));
    }
    
    public function render()
    {
        return view('livewire.admin.prices.index');
    }
}