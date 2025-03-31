<?php

namespace App\Livewire\Admin\MainPage;

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
        $this->page2 = Page::where('type', PageType::MAINPAGE->value)
            ->first();
    }

    public function render()
    {
        return view('livewire.admin.main-page.index');
    }
}
