<?php

namespace App\Livewire\Admin\CheckUp;

use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
use App\Services\Admin\CheckUp\CheckUpService;
use App\Services\Admin\CheckUp\CreateEditService;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public CheckUp $checkUp;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $price = '';

    public string $newPrice = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(CheckUp $checkUp = null)
    {
        $this->checkUp = $checkUp ?? new CheckUp();
        $this->activeLocale = app()->getLocale();
        $this->price = $this->checkUp->price ?? '';
        $this->newPrice = $this->checkUp->new_price ?? '';
        $service = resolve(CreateEditService::class);

        $translations = $service->getTranslations($this->checkUp->id, ['ua', 'en', 'ru']);

        $this->uaTitle = $translations['ua']['title'];
        $this->enTitle = $translations['en']['title'];
        $this->ruTitle = $translations['ru']['title'];

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

            'price' => [
                'required',
                'string',
            ],

            'newPrice' => [
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
            $image = $imageService->downloadImage($this->image, '/check-up');

            if(!empty($this->checkUp->id) && !empty($this->checkUp->image)) {
                $imageService->deleteStorageImage($this->image, $this->checkUp->image);
            }

            $this->checkUp->image = $image;
        }

        $this->checkUp->price = $this->price;
        $this->checkUp->new_price = $this->newPrice;
        $this->checkUp->save();

        $translations = [
            'ua' => ['title' => $this->uaTitle, 'description' => $this->uaDescription],
            'ru' => ['title' => $this->ruTitle, 'description' => $this->ruDescription],
            'en' => ['title' => $this->enTitle, 'description' => $this->enDescription],
        ];

        $service = resolve(CreateEditService::class);

        $service->saveTranslations($this->checkUp->id, $translations);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.check-ups.index');
    }

    public function render()
    {
        return view('livewire.admin.check-up.create-edit');
    }
}
