<?php

namespace App\Livewire\Admin\Surgery\Direction;

use App\Models\Surgery;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public Surgery $surgery;

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function paginationView()
    {
        return 'vendor.pagination.plain';
    }

    public function mount(Surgery $surgery)
    {
        $this->surgery = $surgery;
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
        return view('livewire.admin.surgery.direction.show');
    }
}
