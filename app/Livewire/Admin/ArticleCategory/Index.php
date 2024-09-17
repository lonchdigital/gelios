<?php

namespace App\Livewire\Admin\ArticleCategory;

use App\Models\ArticleCategory;
use App\Models\CheckUp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function getCategoriesProperty()
    {
        $categories = ArticleCategory::paginate(10);

        return $categories;
    }

    public function render()
    {
        return view('livewire.admin.article-category.index');
    }
}
