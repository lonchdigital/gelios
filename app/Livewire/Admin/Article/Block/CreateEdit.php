<?php

namespace App\Livewire\Admin\Article\Block;

use App\Enums\ArticleBlockType;
use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleBlockTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public Article $article;

    public ArticleBlock $block;

    public string $activeLocale;

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
        $this->article = $article;
        $this->block = $block ?? new ArticleBlock();
        $this->activeLocale = app()->getLocale();

        $translations = ArticleBlockTranslation::where('article_block_id', $this->block->id ?? '')->get()->keyBy('locale');

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

        foreach($types as $type) {
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

    public function save()
    {
        $this->validate();

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
            'ua' => $this->uaSecondTitle,
            'en' => $this->enSecondTitle,
            'ru' => $this->ruSecondTitle,
        ];

        foreach ($locales as $locale) {
            ArticleBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'article_block_id' => $this->block->id,
                ],
                [
                    'first_title' => $firstTitles[$locale],
                    'second_title' => $secondTitles[$locale],
                    'first_content' => $this->type !== ArticleBlockType::TWOBLOCKS->value ? $firstDescriptions[$locale] : '',
                    'second_content' => $this->type !== ArticleBlockType::TWOBLOCKS->value ? $secondDescriptions[$locale] : '',
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        return $this->redirectRoute('admin.articles.edit', ['article' => $this->article]);
    }


    public function render()
    {
        return view('livewire.admin.article.block.create-edit');
    }
}