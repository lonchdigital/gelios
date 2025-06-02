<?php

namespace App\Livewire\Admin\Directions;

use App\Models\Direction;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class Index extends Component
{
    use WithFileUploads;

    public Direction|null $direction = null;

    public array $directionName = [];
    public string $directionSlug = '';
    public int $directionTemplate = 1;

    public int|null $directionParent = null;
    public array $directionContacts = [];
    public Collection $allDirectionContacts;

    public array $allDirections = [];
    protected DirectionsService $directionsService;

    public string $search = '';

    public function mount() 
    {
        $this->directionsService = app(DirectionsService::class);
        $this->dispatch('livewire:load');

        $this->allDirectionContacts = $this->directionsService->getAllOffices();

        // $this->directionTemplate = 1;

        if(is_null($this->direction)) {
            $this->allDirections = $this->directionsService->getCachedDirectionsForDashboard();
        } else {
            $allDirections = $this->directionsService->getDirectionsByCategory($this->direction->id);
            $this->allDirections = $this->directionsService->buildTreeForDashboard($allDirections);
        }
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
    }
    
    // public function updated($propertyName)
    // {}

    public function updateOrder($list)
    {
        $ids = collect($list)->pluck('value')->all();
        $directions = Direction::whereIn('id', $ids)->get()->keyBy('id');

        foreach ($list as $item) {
            if (isset($directions[$item['value']])) {
                $directions[$item['value']]->update(['sort' => $item['order']]);
            }
        }

        foreach (config('translatable.locales') as $locale):
            Cache::forget("all_directions_dashboard_{$locale}");
        endforeach;

        if(is_null($this->direction)) {
            $this->allDirections = $this->directionsService->getCachedDirectionsForDashboard();
        } else {
            $allDirections = $this->directionsService->getDirectionsByCategory($this->direction->id);
            $this->allDirections = $this->directionsService->buildTreeForDashboard($allDirections);
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

    public function updatedSearch()
    {        
        if (mb_strlen(trim($this->search)) >= 4) {
            $this->allDirections = $this->directionsService->searchWithParents($this->search);
        } else {
            $this->allDirections = $this->directionsService->getCachedDirectionsForDashboard();
        }
    }

    protected function rules()
    {
        $rules = [];

        $rules['directionName.ua'] = [
            'required',
            'string',
            'max:255'
        ];

        $rules['directionSlug'] = [
            'required',
            'string',
            'unique:page_directions,slug',
            'unique:pages,slug'
        ];
        $rules['directionTemplate'] = [
            'required',
            'integer'
        ];

        return $rules;
    }

    protected function attributes()
    {
        $attributes = [];

        foreach (config('translatable.locales') as $locale) {
            $attributes['directionName.' . $locale] = trans('admin.title') . ' ('. $locale .')';
        }

        $attributes['directionSlug'] = 'slug';

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    public function save()
    {
        $this->validate();

        $beloning = ( $this->directionTemplate === 1 ) ? null : $this->directionParent;
        $formData = [
            'directionName' => $this->directionName,
            'directionSlug' => $this->directionSlug,
            'directionTemplate' => $this->directionTemplate,
            'directionParent' =>  $beloning,
            'directionContacts' => $this->directionContacts,
        ];
        $this->directionsService->addDirection($formData);

        redirect()->route('directions.index')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.index', ['direction' => $this->direction]);
    }

}