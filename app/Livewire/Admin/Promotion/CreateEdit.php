<?php

namespace App\Livewire\Admin\Promotion;

use App\Models\Promotion;
use App\Models\PromotionTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\PromotionService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Promotion $promotion;

    public string $activeLocale;

    public string $description;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaPrice = '';

    public string $enPrice = '';

    public string $ruPrice = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaSlug = '';

    public string $enSlug = '';

    public string $ruSlug = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Promotion $promotion = null)
    {
        $this->dispatch('livewire:load');

        $this->promotion = $promotion ?? new Promotion();

        $this->activeLocale = config('app.active_lang');

        $service = resolve(PromotionService::class);

        $locales = ['ua', 'en', 'ru'];

        $translations = $service->getTranslationsForLocales($this->promotion->id ?? null, $locales);

        $this->uaTitle = $translations['ua']['title'];
        $this->enTitle = $translations['en']['title'];
        $this->ruTitle = $translations['ru']['title'];

        $this->uaPrice = $translations['ua']['price'];
        $this->enPrice = $translations['en']['price'];
        $this->ruPrice = $translations['ru']['price'];

        $this->uaSlug = $translations['ua']['slug'];
        $this->enSlug = $translations['en']['slug'];
        $this->ruSlug = $translations['ru']['slug'];

        $this->uaDescription = $translations['ua']['description'];
        $this->enDescription = $translations['en']['description'];
        $this->ruDescription = $translations['ru']['description'];
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'uaSlug' => [
                'required',
                'string',
                Rule::unique('promotion_translations', 'slug')->where(function ($query) {
                    return $query->where('promotion_id', '!=', $this->promotion->id);
                }),
            ],

            'ruSlug' => [
                'required',
                'string',
                Rule::unique('promotion_translations', 'slug')->where(function ($query) {
                    return $query->where('promotion_id', '!=', $this->promotion->id);
                }),
            ],

            'enSlug' => [
                'required',
                'string',
                Rule::unique('promotion_translations', 'slug')->where(function ($query) {
                    return $query->where('promotion_id', '!=', $this->promotion->id);
                }),
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

            'uaPrice' => [
                'required',
                'string',
            ],

            'enPrice' => [
                'required',
                'string',
            ],

            'ruPrice' => [
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

            'image' => [
                empty($this->promotion->id) ? 'required' : 'nullable',
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
            $image = $imageService->downloadImage($this->image, '/promotions');

            if(!empty($this->promotion->id) && !empty($this->promotion->image)) {
                $imageService->deleteStorageImage($this->image, $this->promotion->image);
            }

            $this->promotion->image = $image;
        }

        $this->promotion->save();

        $translations = [
            'ua' => [
                'title' => $this->uaTitle,
                'price' => $this->uaPrice,
                'description' => $this->uaDescription,
                'slug' => $this->uaSlug,
            ],
            'en' => [
                'title' => $this->enTitle,
                'price' => $this->enPrice,
                'description' => $this->enDescription,
                'slug' => $this->enSlug,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'price' => $this->ruPrice,
                'description' => $this->ruDescription,
                'slug' => $this->ruSlug,
            ]
        ];

        $service = resolve(PromotionService::class);

        $service->saveTranslations($this->promotion->id, $translations);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.promotions.index');
    }

    public function render()
    {
        return view('livewire.admin.promotion.create-edit');
    }
}
