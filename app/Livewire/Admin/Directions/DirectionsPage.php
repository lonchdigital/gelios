<?php

namespace App\Livewire\Admin\Directions;

use App\Models\Page;
use App\Enums\PageType;
use Livewire\Component;
use App\Models\Direction;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use App\Traits\Livewire\SeoPages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;

class DirectionsPage extends Component
{
    use WithFileUploads, SeoPages;

    public Page $page;
    public array $seoData = [];

    protected DirectionsService $directionsService;

    public function mount() 
    {
        $this->directionsService = new DirectionsService;
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::DIRECTIONS->value)->first();

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
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

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('directions.page')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.directions-page', ['page' => $this->page]);
    }

}