<?php

namespace App\Livewire\Admin\Directions;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class Index extends Component
{
    use WithFileUploads;

    public array $directionName = [];
    public int $directionTemplate = 1;
    public int|null $directionParent = null;
    public array $allDirections = [];
    protected DirectionsService $directionsService;
    
    public function mount() 
    {
        $this->directionsService = new DirectionsService;

        $allDirections = $this->directionsService->getAllDirections();
        $this->allDirections = $this->directionsService->buildTree($allDirections);
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
    }
    
    public function updated($propertyName)
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
        $this->validate();

        $formData = [
            'directionName' => $this->directionName,
            'directionTemplate' => $this->directionTemplate,
            'directionParent' => $this->directionParent,
        ];
        $this->directionsService->addDirection($formData);

        redirect()->route('directions.index')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.index');
    }

}