<?php

namespace App\Livewire\Admin\ArticleCategory;

use App\Services\Admin\Article\ArticleCategoryService;
use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public ArticleCategory $category;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    protected $service;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(ArticleCategory $category = null)
    {
        $this->service = resolve(ArticleCategoryService::class);

        $this->category = $category ?? new ArticleCategory();
        $this->activeLocale = app()->getLocale();

        $this->uaTitle = $this->service->getTranslation($this->category, 'ua');
        $this->enTitle = $this->service->getTranslation($this->category, 'en');
        $this->ruTitle = $this->service->getTranslation($this->category, 'ru');
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
        $this->validate();

        $this->category->save();
        
        $service = resolve(ArticleCategoryService::class);

        $service->saveTranslation($this->category, 'ua', $this->uaTitle);
        $service->saveTranslation($this->category, 'ru', $this->ruTitle);
        $service->saveTranslation($this->category, 'en', $this->enTitle);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.article-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.article-category.create-edit');
    }
}
