<?php

namespace App\Livewire\Admin\Laboratory\Price;

use App\Models\LaboratoryCity;
use App\Models\LabPriceCategory;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function getCategoriesProperty()
    {
        $prices = LabPriceCategory::paginate(10);

        return $prices;
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
        return view('livewire.admin.laboratory.price.index');
    }
}
