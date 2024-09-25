<?php

namespace App\Livewire\Admin\Directions;

use App\Models\Direction;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class Index extends Component
{
    use WithFileUploads;

    public Direction|null $direction = null;

    public array $directionName = [];
    public $directionTemplate;
    public int|null $directionParent = null;
    public array $allDirections = [];
    protected DirectionsService $directionsService;

    public function mount() 
    {
        $this->directionsService = new DirectionsService;

        if(is_null($this->direction)) {
            $allDirections = $this->directionsService->getAllDirections();
            $this->allDirections = $this->directionsService->buildTree($allDirections);
        } else {
            $allDirections = $this->directionsService->getDirectionsByCategory($this->direction->id);
            $this->allDirections = $this->directionsService->buildTree($allDirections);
        }
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
    }
    
    public function updated($propertyName)
    {}

    public function updateOrder($list)
    {
        foreach($list as $item){
            Direction::find($item['value'])->update(['sort' => $item['order']]);
        }

        if(is_null($this->direction)) {
            $allDirections = $this->directionsService->getAllDirections();
            $this->allDirections = $this->directionsService->buildTree($allDirections);
        } else {
            $allDirections = $this->directionsService->getDirectionsByCategory($this->direction->id);
            $this->allDirections = $this->directionsService->buildTree($allDirections);
        }
    }

    public function removeDirectionFromDB(int $id)
    {
        if($id) {
            $this->directionsService->removeDirectionWithChildren($id);
            redirect()->route('directions.index')->with('success', trans('admin.removed'));
        }

        redirect()->route('directions.index')->with('error', trans('admin.error'));
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
        return view('livewire.admin.directions.index', ['direction' => $this->direction]);
    }

}