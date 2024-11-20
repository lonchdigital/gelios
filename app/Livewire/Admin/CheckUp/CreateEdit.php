<?php

namespace App\Livewire\Admin\CheckUp;

use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
use App\Services\Admin\CheckUp\CheckUpService;
use App\Services\Admin\CheckUp\CreateEditService;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public CheckUp $checkUp;

    public string $activeLocale;

    public string $description;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaSlug = '';

    public string $enSlug = '';

    public string $ruSlug = '';

    public string $price = '';

    public string $newPrice = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched',
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function mount(CheckUp $checkUp = null)
    {
        $this->dispatch('livewire:load');

        $this->checkUp = $checkUp ?? new CheckUp();
        $this->activeLocale = config('app.active_lang');
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

        $this->uaSlug = $translations['ua']['slug'];
        $this->enSlug = $translations['en']['slug'];
        $this->ruSlug = $translations['ru']['slug'];
    }

    public function refreshItemsAfterDelete()
    {
        $this->dispatch('refresh');
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
                Rule::unique('check_up_translations', 'slug')->where(function ($query) {
                    return $query->where('check_up_id', '!=', $this->checkUp->id);
                }),
            ],

            'ruSlug' => [
                'required',
                'string',
                Rule::unique('check_up_translations', 'slug')->where(function ($query) {
                    return $query->where('check_up_id', '!=', $this->checkUp->id);
                }),
            ],

            'enSlug' => [
                'required',
                'string',
                Rule::unique('check_up_translations', 'slug')->where(function ($query) {
                    return $query->where('check_up_id', '!=', $this->checkUp->id);
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

    public function deleteItem($id, $type)
    {
        $this->dispatch('openModalDeleteItem', $type, $id);
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
            'ua' => [
                'title' => $this->uaTitle,
                'description' => $this->uaDescription,
                'slug' => $this->uaSlug,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'description' => $this->ruDescription,
                'slug' => $this->ruSlug,
            ],
            'en' => [
                'title' => $this->enTitle,
                'description' => $this->enDescription,
                'slug' => $this->enSlug,
            ],
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
