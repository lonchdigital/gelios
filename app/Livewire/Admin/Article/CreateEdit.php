<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;
use App\Models\ArticleTranslation;
use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Article $article;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $slug = '';

    public array $images = [];

    public $image;

    public $imageTemporary;

    public $newImage;

    public $newImageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Article $article = null)
    {
        $this->article = $article ?? new Article();

        $this->activeLocale = app()->getLocale();

        $this->slug = $this->article->slug ?? '';

        $translations = ArticleTranslation::where('article_id',
            $this->article->id)
            ->get()
            ->keyBy('locale');

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        foreach($this->article->images ?? [] as $image) {
            $this->images[] = [
                'image' => $image,
                'imageUrl' => Storage::disk('public')->url($image),
            ];
        }
    }

    public function updatedNewImage($val)
    {
        $this->validate([
            'newImage' => 'required|image',
        ]);

        $this->newImage = null;

        $this->images[] = [
            'image' => $val,
            'imageUrl' => $val->temporaryUrl(),
        ];
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

            'uaDescription' => [
                'required',
                'string',
            ],

            'enDescription' => [
                'required',
                'string',
            ],

            'ruDescription' => [
                'required',
                'string',
            ],

            'slug' => [
                'required',
                'string',
                'unique:articles,slug,' . $this->article->slug ?? ''
            ],
        ];
    }

    public function updatedImage($val)
    {
        $this->validateOnly('image');
        $this->image = $val;
        $this->imageTemporary = $val->temporaryUrl();
    }

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/article', $file);

        return $image;
    }

    public function deleteStorageImage($image)
    {
        if ($image && $this->article->image) {
            Storage::disk('public')->delete($this->article->image);
        }
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        if($this->image) {
            $image = $this->downloadImage($this->image);

            $this->deleteStorageImage($image);

            $this->article->image = $image;
        }

        $images = [];

        foreach($this->images as $image2) {
            if(!in_array($image2['image'], $this->article->images ?? [])) {
                $images[] = $this->downloadImage($image2['image']);
            } else {
                $images[] = $image2['image'];
            }
        }

        foreach($this->article->images ?? [] as $image3) {
            if(!in_array($image3, $images)) {
                $this->deleteAdditionalImage($image3);
            }
        }

        $this->article->slug = $this->slug;

        $this->article->images = $images;

        $this->article->save();

        $locales = ['ua', 'en', 'ru'];

        $titles = [
            'ua' => $this->uaTitle,
            'en' => $this->enTitle,
            'ru' => $this->ruTitle,
        ];

        $descriptions = [
            'ua' => $this->uaDescription,
            'en' => $this->enDescription,
            'ru' => $this->ruDescription,
        ];

        foreach ($locales as $locale) {
            ArticleTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'article_id' => $this->article->id,
                ],
                [
                    'title' => $titles[$locale],
                    'description' => $descriptions[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.articles.index');
    }

    public function deleteNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function deleteAdditionalImage($image)
    {
        if(Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function newPosition($val, ArticleBlock $block)
    {
        ArticleBlock::where('sort', $block->sort + $val)->first()->update([
            'sort' => $block->sort,
        ]);

        $block->update([
            'sort' => $block->sort + $val,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.article.create-edit');
    }
}
