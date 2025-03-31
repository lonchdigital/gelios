<?php

namespace App\Livewire\Admin\Promotion;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Promotion;
use Livewire\Component;

class Index extends Component
{
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
        $this->page2 = Page::where('type', PageType::SHARES->value)->first();
    }

    public function getPromotionsProperty()
    {
        $promotions = Promotion::get();

        return $promotions;
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
        return view('livewire.admin.promotion.index');
    }
}
