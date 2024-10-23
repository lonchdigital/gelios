<?php

namespace App\Livewire\Admin\Promotion;

use App\Models\Promotion;
use App\Models\PromotionTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\PromotionService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Promotion $promotion;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaPrice = '';

    public string $enPrice = '';

    public string $ruPrice = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $slug = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Promotion $promotion = null)
    {
        $this->promotion = $promotion ?? new Promotion();
        $this->slug = $this->promotion->slug ?? '';

        $this->activeLocale = app()->getLocale();

        $service = resolve(PromotionService::class);

        $locales = ['ua', 'en', 'ru'];

        $translations = $service->getTranslationsForLocales($this->promotion->id ?? null, $locales);

        $this->uaTitle = $translations['ua']['title'];
        $this->enTitle = $translations['en']['title'];
        $this->ruTitle = $translations['ru']['title'];

        $this->uaPrice = $translations['ua']['price'];
        $this->enPrice = $translations['en']['price'];
        $this->ruPrice = $translations['ru']['price'];

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
            'slug' => [
                'required',
                'string',
                'unique:promotions,slug,' . $this->promotion->id ?? ''
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

        $this->promotion->slug = $this->slug;
        $this->promotion->save();

        $translations = [
            'ua' => [
                'title' => $this->uaTitle,
                'price' => $this->uaPrice,
                'description' => $this->uaDescription,
            ],
            'en' => [
                'title' => $this->enTitle,
                'price' => $this->enPrice,
                'description' => $this->enDescription,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'price' => $this->ruPrice,
                'description' => $this->ruDescription,
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
