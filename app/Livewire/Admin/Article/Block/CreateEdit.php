<?php

namespace App\Livewire\Admin\Article\Block;

use App\Enums\ArticleBlockType;
use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleBlockTranslation;
use App\Services\Admin\Article\ArticleBlockService;
use Livewire\Component;

class CreateEdit extends Component
{
    public Article $article;

    public ArticleBlock $block;

    public string $activeLocale;

    public string $description;

    public string $description2;

    public string $uaFirstTitle = '';

    public string $enFirstTitle = '';

    public string $ruFirstTitle = '';

    public string $uaSecondTitle = '';

    public string $enSecondTitle = '';

    public string $ruSecondTitle = '';

    public string $uaFirstDescription = '';

    public string $enFirstDescription = '';

    public string $ruFirstDescription = '';

    public string $uaSecondDescription = '';

    public string $enSecondDescription = '';

    public string $ruSecondDescription = '';

    public string $type = '';

    public array $types = [];

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Article $article, ArticleBlock $block = null)
    {
        $this->dispatch('livewire:load');

        $this->article = $article;
        $this->block = $block ?? new ArticleBlock();
        $this->activeLocale = config('app.active_lang');

        $service = resolve(ArticleBlockService::class);

        $translations = $service->getTranslations($this->block->id ?? '');

        $this->uaFirstTitle = $translations['ua']->first_title ?? '';
        $this->enFirstTitle = $translations['en']->first_title ?? '';
        $this->ruFirstTitle = $translations['ru']->first_title ?? '';

        $this->uaSecondTitle = $translations['ua']->second_title ?? '';
        $this->enSecondTitle = $translations['en']->second_title ?? '';
        $this->ruSecondTitle = $translations['ru']->second_title ?? '';

        $this->uaFirstDescription = $translations['ua']->first_content ?? '';
        $this->enFirstDescription = $translations['en']->first_content ?? '';
        $this->ruFirstDescription = $translations['ru']->first_content ?? '';

        $this->uaSecondDescription = $translations['ua']->second_content ?? '';
        $this->enSecondDescription = $translations['en']->second_content ?? '';
        $this->ruSecondDescription = $translations['ru']->second_content ?? '';

        $types = ArticleBlockType::cases();

        foreach ($types as $type) {
            $this->types[] = $type->value;
        }

        $this->type = $this->block->type ?? $this->types[0] ?? '';
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'uaFirstTitle' => [
                'nullable',
                'string',
            ],

            'enFirstTitle' => [
                'nullable',
                'string',
            ],

            'ruFirstTitle' => [
                'nullable',
                'string',
            ],

            'uaSecondTitle' => [
                'nullable',
                'string',
            ],

            'enSecondTitle' => [
                'nullable',
                'string',
            ],

            'ruSecondTitle' => [
                'nullable',
                'string',
            ],

            'uaFirstDescription' => [
                'nullable',
                'string',
            ],

            'enFirstDescription' => [
                'nullable',
                'string',
            ],

            'ruFirstDescription' => [
                'nullable',
                'string',
            ],

            'uaSecondDescription' => [
                'nullable',
                'string',
            ],

            'enSecondDescription' => [
                'nullable',
                'string',
            ],

            'ruSecondDescription' => [
                'nullable',
                'string',
            ],

            'type' => [
                'required',
                'string',
                'in:' . implode(',', $this->types),
            ]
        ];
    }

    public function updatedType()
    {
        // $this->dispatch('livewire:load');
    }

    public function updatedDescription($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaFirstDescription = $val;
                break;
            case 'ru':
                $this->ruFirstDescription = $val;
                break;
            case 'en':
                $this->enFirstDescription = $val;
                break;
        }
    }

    public function updatedDescription2($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaSecondDescription = $val;
                break;
            case 'ru':
                $this->ruSecondDescription = $val;
                break;
            case 'en':
                $this->enSecondDescription = $val;
                break;
        }
    }

    public function save()
    {
        $this->validate();

        if($this->type == 'one_block') {
            $this->uaSecondTitle = '';
            $this->enSecondTitle = '';
            $this->ruSecondTitle = '';

            $this->uaSecondDescription = '';
            $this->enSecondDescription = '';
            $this->ruSecondDescription = '';
        }

        $this->block->article_id = $this->article->id;
        $this->block->type = $this->type;
        $this->block->sort = $this->block->sort ?? $this->article->articleBlocks->count() + 1;
        $this->block->save();

        $locales = ['ua', 'en', 'ru'];

        $firstTitles = [
            'ua' => $this->uaFirstTitle,
            'en' => $this->enFirstTitle,
            'ru' => $this->ruFirstTitle,
        ];

        $secondTitles = [
            'ua' => $this->uaSecondTitle,
            'en' => $this->enSecondTitle,
            'ru' => $this->ruSecondTitle,
        ];

        $firstDescriptions = [
            'ua' => $this->uaFirstDescription,
            'en' => $this->enFirstDescription,
            'ru' => $this->ruFirstDescription,
        ];

        $secondDescriptions = [
            'ua' => $this->uaSecondDescription,
            'en' => $this->enSecondDescription,
            'ru' => $this->ruSecondDescription,
        ];

        $service = resolve(ArticleBlockService::class);

        $service->saveTranslations(
            $this->block->id,
            $locales,
            $firstTitles,
            $secondTitles,
            $firstDescriptions,
            $secondDescriptions,
            $this->type
        );

        session()->flash('success', 'Дані успішно збережено');

        return $this->redirectRoute('admin.articles.edit', ['article' => $this->article]);
    }


    public function render()
    {
        return view('livewire.admin.article.block.create-edit');
    }
}
