<?php

namespace App\Livewire\Admin\Laboratory\City;

use App\Models\LaboratoryCity;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];
    
    public function getCitiesProperty()
    {
        $cities = LaboratoryCity::paginate(10);

        return $cities;
    }

    public function deleteItem($id, $type)
    {
        $this->dispatch('openModalDeleteItem', $type, $id);
    }

    public function refreshItemsAfterDelete()
    {
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.admin.laboratory.city.index');
    }
}
