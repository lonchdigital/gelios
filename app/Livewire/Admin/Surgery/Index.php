<?php

namespace App\Livewire\Admin\Surgery;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Surgery;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Page $page2;

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function paginationView()
    {
        return 'vendor.pagination.plain';
    }

    public function mount()
    {
        $this->page2 = Page::where('type', PageType::SURGERY->value)
            ->first();
    }

    public function getSurgeriesProperty()
    {
        $surgeries = Surgery::get();

        return $surgeries;
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
        return view('livewire.admin.surgery.index');
    }
}
