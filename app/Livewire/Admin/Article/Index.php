<?php

namespace App\Livewire\Admin\Article;

use App\Enums\PageType;
use App\Models\Article;
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

    public function mount()
    {
        $this->page2 = Page::where('type', PageType::BLOG->value)->first();
    }

    public function getArticlesProperty()
    {
        $articles = Article::paginate(10);

        return $articles;
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
        return view('livewire.admin.article.index');
    }
}
