<?php

namespace App\Livewire\Admin\ArticleCategory;

use App\Models\ArticleCategory;
use App\Models\CheckUp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

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
        $categories = ArticleCategory::paginate(10);

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
        return view('livewire.admin.article-category.index');
    }
}
