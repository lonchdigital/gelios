<?php

namespace App\Livewire\Admin\Settings;

use App\Models\HeaderAffiliate;
use App\Models\HeaderCity;
use App\Models\Setting;
use App\Services\Admin\FooterHeaderService;
use App\Services\Admin\HeaderService;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditHeader extends Component
{
    use WithFileUploads;

    public string $activeLocale;

    public $firstCity;

    public $secondCity;

    public string $firstCityFirstPhone;

    public string $firstCitySecondPhone;

    public string $secondCityFirstPhone;

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

    public $headerSecondAffiliates = [];

    public $translatedSecondAddresses = [];

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount()
    {
        $this->activeLocale = config('app.active_lang');

        $this->firstCity = HeaderCity::first() ?? null;

        $this->loadValues($this->firstCity);

        $this->secondCity = HeaderCity::where('id', '!=', $this->firstCity->id)->first() ?? null;

        $this->loadValues2($this->secondCity);

        $this->headerAffiliates = HeaderAffiliate::where('header_city_id', $this->firstCity->id)
            ->get()
            ->toArray();

        foreach ($this->headerAffiliates as $index => $affiliate) {
            $headerAffiliate = HeaderAffiliate::find($affiliate['id']);

            foreach (config('app.available_languages') as $locale) {
                $this->translatedAddresses[$index][$locale] = $headerAffiliate
                ->translations()
                ->where('locale', $locale)
                ->first()->address;
            }
        }

        $this->headerSecondAffiliates = HeaderAffiliate::where('header_city_id', $this->secondCity->id)
            ->get()
            ->toArray();

        foreach ($this->headerSecondAffiliates as $index => $affiliate) {
            $headerAffiliate = HeaderAffiliate::find($affiliate['id']);

            foreach (config('app.available_languages') as $locale) {
                $this->translatedSecondAddresses[$index][$locale] = $headerAffiliate
                    ->translations()
                    ->where('locale', $locale)
                    ->first()->address;
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

        $this->firstCityFirstPhone = $firstCity->first_phone ?? '';

        $this->firstCitySecondPhone = $firstCity->second_phone ?? '';

        $this->headImage = $values->where('key', 'header_image')->first();
    }

    public function loadValues2(HeaderCity $secondCity)
    {
        $this->uaSecondCity = $secondCity->translate('ua')->title ?? '';
        $this->enSecondCity = $secondCity->translate('en')->title ?? '';
        $this->ruSecondCity = $secondCity->translate('ru')->title ?? '';

        $this->secondCityFirstPhone = $secondCity->first_phone ?? '';
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

            'firstCityFirstPhone' => [
                'nullable',
                'string',
            ],

            'firstCitySecondPhone' => [
                'nullable',
                'string',
            ],

            'secondCityFirstPhone' => [
                'nullable',
                'string',
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

        foreach ($this->headerAffiliates as $index => $affiliateData) {
            $headerAffiliate = HeaderAffiliate::find($affiliateData['id']);

            $headerAffiliate->fill($affiliateData);
            $headerAffiliate->save();

            foreach ($this->translatedAddresses[$index] as $locale => $address) {
                $headerAffiliate->translateOrNew($locale)->address = $address;
            }
            $headerAffiliate->save();
        }

        foreach ($this->headerSecondAffiliates as $index => $affiliateData) {
            $headerAffiliate = HeaderAffiliate::find($affiliateData['id']);

            $headerAffiliate->fill($affiliateData);
            $headerAffiliate->save();

            foreach ($this->translatedSecondAddresses[$index] as $locale => $address) {
                $headerAffiliate->translateOrNew($locale)->address = $address;
            }
            $headerAffiliate->save();
        }

        $this->saveCities();

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

    public function saveCities()
    {
        $service = resolve(HeaderService::class);

        $service->saveCity($this->firstCity, [
            'ua' => $this->uaFirstCity,
            'ru' => $this->ruFirstCity,
            'en' => $this->enFirstCity,
        ], [
            'first_phone' => $this->firstCityFirstPhone,
            'second_phone' => $this->firstCitySecondPhone,
        ]);

        $service->saveCity($this->secondCity, [
            'ua' => $this->uaSecondCity,
            'ru' => $this->ruSecondCity,
            'en' => $this->enSecondCity,
        ], [
            'first_phone' => $this->secondCityFirstPhone,
        ]);
    }

    // public function saveCity()
    // {
    //     $description = Setting::where('key', 'footer_description')->first();

    //     $description->translateOrNew('ua')->text = $this->uaDescription;
    //     $description->translateOrNew('en')->text = $this->enDescription;
    //     $description->translateOrNew('ru')->text = $this->ruDescription;

    //     $description->save();
    // }

    public function render()
    {
        return view('livewire.admin.settings.edit-header');
    }
}
