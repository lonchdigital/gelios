<?php

namespace App\Livewire\Admin\DoctorCategory;

use App\Models\DoctorCategory;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function paginationView()
    {
        return 'vendor.pagination.plain';
    }

    public function getCategoriesProperty()
    {
        $categories = DoctorCategory::paginate(10);

        return $categories;
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
        return view('livewire.admin.doctor-category.index');
    }
}
