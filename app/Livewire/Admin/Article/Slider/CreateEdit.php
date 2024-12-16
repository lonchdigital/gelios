<?php

namespace App\Livewire\Admin\Article\Slider;

use App\Models\Article;
use App\Models\ArticleSlider;
use App\Services\Admin\Article\SliderService;
use App\Services\Admin\ImageService;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Article $article;

    public ArticleSlider $slide;

    public string $activeLocale;

    public $description;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Article $article, ArticleSlider $slide = null)
    {
        $this->dispatch('livewire:load');

        $this->article = $article;
        $this->slide = $slide ?? new ArticleSlider();
        $this->activeLocale = config('app.active_lang');

        $service = resolve(SliderService::class);
        $translations = $service->getTranslations($this->slide);

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
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

            'image' => [
                empty($this->slide->id) ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],
        ];
    }

    public function updatedDescription($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaDescription = $val;
                break;
            case 'ru':
                $this->ruDescription = $val;
                break;
            case 'en':
                $this->enDescription = $val;
                break;
        }
    }

    public function updatedImage($val)
    {
        $this->validateOnly('image');
        $this->image = $val;
        $this->imageTemporary = $val->temporaryUrl();
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        $imageService = resolve(ImageService::class);

        if ($this->image) {
            $image = $imageService->downloadImage($this->image, '/static-blocks');

            if (!empty($this->slide->id) && !empty($this->slide->image)) {
                $imageService->deleteStorageImage($this->image, $this->slide->image);
            }

            $this->slide->image = $image;
        }

        $descriptions = [
            'ua' => [
                'title' => $this->uaTitle,
                'description' => $this->uaDescription,
            ],
            'en' => [
                'title' => $this->enTitle,
                'description' => $this->enDescription,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'description' => $this->ruDescription,
            ],
        ];

        $data = [
            'sort' => $this->slide->sort ?? $this->article->articleSliders()->count() + 1,
            'article_id' => $this->article->id,
        ];

        $service = resolve(SliderService::class);

        $service->saveSlider($this->slide, $data, $descriptions);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.articles.edit', ['article' => $this->article]);
    }

    public function render()
    {
        return view('livewire.admin.article.slider.create-edit');
    }
}
