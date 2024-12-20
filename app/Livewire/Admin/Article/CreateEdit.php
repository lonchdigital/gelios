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
use App\Models\Doctor;
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

    public $categoryId;

    public $doctorId;

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
        $this->categoryId = $this->article->article_category_id ?? null;
        $this->doctorId = $this->article->doctor_id ?? null;

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

            'doctorId' => [
                'nullable',
                'exists:doctors,id'
            ],

            'categoryId' => [
                'nullable',
                'exists:article_categories,id'
            ]
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

    public function getDoctorsProperty()
    {
        $doctors = Doctor::get();

        return $doctors;
    }

    public function getCategoriesProperty()
    {
        $categories = ArticleCategory::get();

        return $categories;
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

        // $this->article->images = $imageService->processImages($this->article->images, $this->images);

        $this->article->slug = $this->slug;
        $this->article->doctor_id = $this->doctorId ?? null;
        $this->article->article_category_id = $this->categoryId ?? null;
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
