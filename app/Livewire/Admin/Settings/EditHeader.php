<?php

namespace App\Livewire\Admin\Settings;

use App\Models\HeaderAffiliate;
use App\Models\HeaderCity;
use App\Models\Setting;
use App\Services\Admin\FooterHeaderService;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditHeader extends Component
{
    use WithFileUploads;

    public string $activeLocale;

    public string $uaFirstCity = '';

    public string $enFirstCity = '';

    public string $ruFirstCity = '';

    public string $uaSecondCity = '';

    public string $enSecondCity = '';

    public string $ruSecondCity = '';

    public Setting $headImage;

    public $headerImage;

    public $headerImageTemporary;

    public $headerAffiliates = [];

    public $translatedAddresses = [];

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount()
    {
        $this->activeLocale = config('app.active_lang');

        $firstCity = HeaderCity::first() ?? null;

        $this->loadValues($firstCity);

        // $secondCity = HeaderCity::where('id', '!=', $firstCity->id)->first() ?? null;

        $this->headerAffiliates = HeaderAffiliate::where('header_city_id', $firstCity->id)->get()->toArray();

        foreach ($this->headerAffiliates as $index => $affiliate) {
            $headerAffiliate = HeaderAffiliate::find($affiliate['id']);

            foreach (config('app.available_languages') as $locale) {
                $this->translatedAddresses[$index][$locale] = $headerAffiliate->getTranslation('address', $locale);
            }
        }
    }

    public function loadValues(HeaderCity $firstCity)
    {
        $service = resolve(FooterHeaderService::class);

        $values = $service->loadSettings();

        $this->uaFirstCity = $firstCity->translate('ua')->title ?? '';
        $this->enFirstCity = $firstCity->translate('en')->title ?? '';
        $this->ruFirstCity = $firstCity->translate('ru')->title ?? '';

        $this->headImage = $values->where('key', 'header_image')->first();
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'uaFirstCity' => [
                'required',
                'string',
            ],

            'enFirstCity' => [
                'required',
                'string',
            ],

            'ruFirstCity' => [
                'required',
                'string',
            ],

            'uaSecondCity' => [
                'required',
                'string',
            ],

            'enSecondCity' => [
                'required',
                'string',
            ],

            'ruSecondCity' => [
                'required',
                'string',
            ],

            'headerImage' => [
                'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],

            'headerAffiliates.*.first_phone' => [
                'required',
                'string',
                'max:255',
            ],

            'headerAffiliates.*.second_phone' => [
                'nullable',
                'string',
                'max:255',
            ],

            'headerAffiliates.*.email' => [
                'nullable',
                'string',
                'max:255',
            ],

            'headerAffiliates.*.hours' => [
                'nullable',
                'string',
                'max:255',
            ],

            'headerAffiliates.*.latitude' => [
                'nullable',
                'numeric',
            ],

            'headerAffiliates.*.longitude' => [
                'nullable',
                'numeric',
            ],

            'translatedAddresses.*.*' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function updatedHeaderImage($val)
    {
        $this->validateOnly('headerImage');
        $this->headerImage = $val;
        $this->headerImageTemporary = $val->temporaryUrl();
    }

    public function deleteHeaderImage()
    {
        $this->headerImage = null;
        $this->headerImageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        $this->saveImages();

        $this->saveDescription();

        // $this->saveSocials();
        foreach ($this->headerAffiliates as $index => $affiliateData) {
            $headerAffiliate = HeaderAffiliate::find($affiliateData['id']);

            $headerAffiliate->fill($affiliateData);
            $headerAffiliate->save();

            foreach ($this->translatedAddresses[$index] as $locale => $address) {
                $headerAffiliate->setTranslation('address', $locale, $address);
            }
            $headerAffiliate->save();
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.header.edit');
    }

    public function saveImages()
    {
        $imageService = resolve(ImageService::class);

        if ($this->headerImage) {
            $image = $imageService->downloadImage($this->headerImage, '/header');

            if (!empty($this->headImage->value)) {
                $imageService->deleteStorageImage($image, $this->headImage->value);
            }

            Setting::where('key', 'header_image')->first()->update([
                'value' => $image,
            ]);
        }
    }

    public function saveCity()
    {
        $description = Setting::where('key', 'footer_description')->first();

        $description->translateOrNew('ua')->text = $this->uaDescription;
        $description->translateOrNew('en')->text = $this->enDescription;
        $description->translateOrNew('ru')->text = $this->ruDescription;

        $description->save();
    }

    public function render()
    {
        return view('livewire.admin.settings.edit-header');
    }
}
