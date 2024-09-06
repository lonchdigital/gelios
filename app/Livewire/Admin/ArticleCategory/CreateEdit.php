<?php

namespace App\Livewire\Admin\ArticleCategory;

use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;
use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    public ArticleCategory $category;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';
    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(ArticleCategory $category = null)
    {
        $this->category = $category ?? new ArticleCategory();

        $this->activeLocale = app()->getLocale();

        $this->uaTitle = ArticleCategoryTranslation::where('locale', 'ua')
            ->where('article_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = ArticleCategoryTranslation::where('locale', 'en')
            ->where('article_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = ArticleCategoryTranslation::where('locale', 'ru')
            ->where('article_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'uaTitle' => [
                'required',
                'string',
            ],

            'enTitle' => [
                'required',
                'string',
            ],

            'ruTitle' => [
                'required',
                'string',
            ],
        ];
    }

    public function save()
    {
        $this->category->save();

        ArticleCategoryTranslation::updateOrCreate([
            'locale' => 'ua',
            'article_category_id' => $this->category->id,
        ], [
            'title' => $this->uaTitle,
        ]);

        ArticleCategoryTranslation::updateOrCreate([
            'locale' => 'ru',
            'article_category_id' => $this->category->id,
        ], [
            'title' => $this->ruTitle,
        ]);

        ArticleCategoryTranslation::updateOrCreate([
            'locale' => 'en',
            'article_category_id' => $this->category->id,
        ], [
            'title' => $this->enTitle,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.article-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.article-category.create-edit');
    }
}
