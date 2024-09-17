<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function getArticlesProperty()
    {
        $articles = Article::paginate(10);

        return $articles;
    }

    public function render()
    {
        return view('livewire.admin.article.index');
    }
}
