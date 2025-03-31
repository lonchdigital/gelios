<?php

namespace App\Livewire\Admin\Laboratory;

use App\Enums\PageType;
use App\Models\Laboratory;
use App\Models\Page;
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
        $this->page2 = Page::where('type', PageType::LABORATORY->value)->first();
    }

    public function getLaboratoriesProperty()
    {
        $laboratories = Laboratory::paginate(10);

        return $laboratories;
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
        return view('livewire.admin.laboratory.index');
    }
}
