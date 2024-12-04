<?php

namespace App\Livewire\Admin\Specialization;

use App\Models\DoctorCategory;
use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function getSpecializationsProperty()
    {
        $specializations = Specialization::paginate(10);

        return $specializations;
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
        return view('livewire.admin.specialization.index');
    }
}
