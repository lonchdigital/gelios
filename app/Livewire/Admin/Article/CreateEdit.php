<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;
use App\Models\ArticleSlider;
use App\Models\ArticleTranslation;
use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
use App\Services\Admin\Article\ArticleService;
use App\Services\Admin\Article\SliderService;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Article $article;

    public string $description;

    public string $authorDescription;

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

    public string $uaAuthorTitle = '';

    public string $enAuthorTitle = '';

    public string $ruAuthorTitle = '';

    public string $uaAuthorSpecialization = '';

    public string $enAuthorSpecialization = '';

    public string $ruAuthorSpecialization = '';

    public string $uaAuthorDescription = '';

    public string $enAuthorDescription = '';

    public string $ruAuthorDescription = '';

    public $authorImage;

    public $authorImageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched',
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function mount(Article $article = null)
    {
        $this->dispatch('livewire:load');

        $this->article = $article ?? new Article();
        $this->activeLocale = config('app.active_lang');
        $this->slug = $this->article->slug ?? '';

        $this->loadTranslations();
        $this->loadImages();
    }

    private function loadImages()
    {
        foreach ($this->article->images ?? [] as $image) {
            $this->images[] = [
                'image' => $image,
                'imageUrl' => Storage::disk('public')->url($image),
            ];
        }
    }

    private function loadTranslations()
    {
        $service = resolve(ArticleService::class);

        $translations = $service->getTranslations($this->article->id ?? null);

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        $this->uaAuthorTitle = $translations['ua']->author_name ?? '';
        $this->enAuthorTitle = $translations['en']->author_name ?? '';
        $this->ruAuthorTitle = $translations['ru']->author_name ?? '';

        $this->uaAuthorSpecialization = $translations['ua']->author_specialization ?? '';
        $this->enAuthorSpecialization = $translations['en']->author_specialization ?? '';
        $this->ruAuthorSpecialization = $translations['ru']->author_specialization ?? '';

        $this->uaAuthorDescription = $translations['ua']->author_description ?? '';
        $this->enAuthorDescription = $translations['en']->author_description ?? '';
        $this->ruAuthorDescription = $translations['ru']->author_description ?? '';
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

        // $this->dispatch('livewire:load');
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

            'uaAuthorTitle' => [
                'required',
                'string',
            ],

            'enAuthorTitle' => [
                'required',
                'string',
            ],

            'ruAuthorTitle' => [
                'required',
                'string',
            ],

            'uaAuthorSpecialization' => [
                'required',
                'string',
            ],

            'enAuthorSpecialization' => [
                'required',
                'string',
            ],

            'ruAuthorSpecialization' => [
                'required',
                'string',
            ],

            'uaAuthorDescription' => [
                'required',
                'string',
            ],

            'enAuthorDescription' => [
                'required',
                'string',
            ],

            'ruAuthorDescription' => [
                'required',
                'string',
            ],

            'slug' => [
                'required',
                'string',
                'unique:articles,slug,' . $this->article->id ?? ''
            ],

            'image' => [
                empty($this->article->id) ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],

            'authorImage' => [
                empty($this->article->id) ? 'required' : 'nullable',
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

    public function updatedAuthorDescription($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaAuthorDescription = $val;
                break;
            case 'ru':
                $this->ruAuthorDescription = $val;
                break;
            case 'en':
                $this->enAuthorDescription = $val;
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

    public function updatedAuthorImage($val)
    {
        $this->validateOnly('author_image');
        $this->authorImage = $val;
        $this->authorImageTemporary = $val->temporaryUrl();
    }

    public function deleteAuthorImage()
    {
        $this->authorImage = null;
        $this->authorImageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        $imageService = resolve(ImageService::class);

        if($this->image) {
            $image = $imageService->downloadImage($this->image, '/article');

            if(!empty($this->article->id) && !empty($this->article->image)) {
                $imageService->deleteStorageImage($this->image, $this->article->image);
            }

            $this->article->image = $image;
        }

        if($this->authorImage) {
            $image = $imageService->downloadImage($this->authorImage, '/article');

            if(!empty($this->article->id) && !empty($this->article->author_image)) {
                $imageService->deleteStorageImage($this->authorImage, $this->article->authorImage);
            }

            $this->article->author_image = $image;
        }

        $this->article->images = $imageService->processImages($this->article->images, $this->images);

        $this->article->slug = $this->slug;
        $this->article->save();

        $this->saveTranslations();

        session()->flash('success', 'Дані успішно збережено');

        return $this->redirectRoute('admin.articles.index');
    }

    private function saveTranslations()
    {
        $service = resolve(ArticleService::class);

        $service->saveTranslations(
            $this->article->id,
            [
                'ua' => $this->uaTitle,
                'en' => $this->enTitle,
                'ru' => $this->ruTitle,
            ],
            [
                'ua' => $this->uaDescription,
                'en' => $this->enDescription,
                'ru' => $this->ruDescription,
            ],
            [
                'ua' => $this->uaAuthorTitle,
                'en' => $this->enAuthorTitle,
                'ru' => $this->ruAuthorTitle,
            ],
            [
                'ua' => $this->uaAuthorDescription,
                'en' => $this->enAuthorDescription,
                'ru' => $this->ruAuthorDescription,
            ],
            [
                'ua' => $this->uaAuthorSpecialization,
                'en' => $this->enAuthorSpecialization,
                'ru' => $this->ruAuthorSpecialization,
            ],
        );
    }

    public function deleteNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function newPosition($val, ArticleBlock $block)
    {
        $service = resolve(ArticleService::class);

        $service->updatePosition($block, $val);
    }

    public function newSliderPosition($val, ArticleSlider $slide)
    {
        $service = resolve(SliderService::class);

        $service->updatePosition($slide, $val);
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
        return view('livewire.admin.article.create-edit');
    }
}
