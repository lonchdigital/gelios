<?php

namespace App\Livewire\Admin\Settings;

use App\Models\HeaderAffiliate;
use App\Models\Setting;
use App\Services\Admin\FooterHeaderService;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditFooter extends Component
{
    use WithFileUploads;

    public string $activeLocale;

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $facebook = '';

    public string $inst = '';

    public string $youtube = '';

    public Setting $footImage;

    public $footerAffiliates = [];

    public $footerImage;

    public $footerImageTemporary;

    public $translatedAddresses = [];

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount()
    {
        $this->activeLocale = config('app.active_lang');
        $this->loadValues();

        $this->footerAffiliates = HeaderAffiliate::where('header_city_id', null)
            ->get()
            ->toArray();

        foreach ($this->footerAffiliates as $index => $affiliate) {
            $footerAffiliate = HeaderAffiliate::find($affiliate['id']);

            foreach (config('app.available_languages') as $locale) {
                $this->translatedAddresses[$index][$locale] = $footerAffiliate
                ->translations()
                ->where('locale', $locale)
                ->first()->address;
            }
        }
    }

    public function loadValues()
    {
        $service = resolve(FooterHeaderService::class);

        $values = $service->loadSettings();

        $description = $values->where('key', 'footer_description')->first();

        $this->uaDescription = $description->translate('ua')->text ?? '';
        $this->enDescription = $description->translate('en')->text ?? '';
        $this->ruDescription = $description->translate('ru')->text ?? '';

        $this->footImage = $values->where('key', 'footer_image')->first();

        $this->facebook = $values->where('key', 'facebook_link')->first()->value ?? '';
        $this->inst = $values->where('key', 'instagram_link')->first()->value ?? '';
        $this->youtube = $values->where('key', 'youtube_link')->first()->value ?? '';
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

            'facebook' => [
                'required',
                'string',
            ],

            'inst' => [
                'required',
                'string',
            ],

            'youtube' => [
                'required',
                'string',
            ],

            'footerImage' => [
                'nullable',
                'mimes:jpeg,jpg,png,gif,svg',
                'image',
            ],

            'footerAffiliates.*.first_phone' => [
                'required',
                'string',
                'max:255',
            ],

            'footerAffiliates.*.second_phone' => [
                'nullable',
                'string',
                'max:255',
            ],

            'footerAffiliates.*.email' => [
                'nullable',
                'string',
                'max:255',
            ],

            'footerAffiliates.*.hours' => [
                'nullable',
                'string',
                'max:255',
            ],

            'footerAffiliates.*.latitude' => [
                'nullable',
                'numeric',
            ],

            'footerAffiliates.*.longitude' => [
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

    public function updatedFooterImage($val)
    {
        $this->validateOnly('footerImage');
        $this->footerImage = $val;
        $this->footerImageTemporary = $val->temporaryUrl();
    }

    public function deleteFooterImage()
    {
        $this->footerImage = null;
        $this->footerImageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        foreach ($this->footerAffiliates as $index => $affiliateData) {
            $footerAffiliate = HeaderAffiliate::find($affiliateData['id']);

            $footerAffiliate->fill($affiliateData);
            $footerAffiliate->save();

            foreach ($this->translatedAddresses[$index] as $locale => $address) {
                $footerAffiliate->translateOrNew($locale)->address = $address;
            }

            $footerAffiliate->save();
        }

        $this->saveImages();

        $this->saveDescription();

        $this->saveSocials();

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.footer.edit');
    }

    public function saveImages()
    {
        $imageService = resolve(ImageService::class);

        if ($this->footerImage) {
            $image = $imageService->downloadImage($this->footerImage, '/footer');

            if (!empty(Setting::where('key', 'footer_image')->first()->value)) {
                $imageService->deleteStorageImage($image,
                    Setting::where('key', 'footer_image')->first()->value);
            }

            Setting::where('key', 'footer_image')->first()->update([
                'value' => $image,
            ]);
        }
    }

    public function saveDescription()
    {
        $description = Setting::where('key', 'footer_description')->first();

        $description->translateOrNew('ua')->text = $this->uaDescription;
        $description->translateOrNew('en')->text = $this->enDescription;
        $description->translateOrNew('ru')->text = $this->ruDescription;

        $description->save();
    }

    public function saveSocials()
    {
        Setting::where('key', 'facebook_link')->first()->update([
            'value' => $this->facebook,
        ]);

        Setting::where('key', 'instagram_link')->first()->update([
            'value' => $this->inst,
        ]);

        Setting::where('key', 'youtube_link')->first()->update([
            'value' => $this->youtube,
        ]);
    }

    public function getAffiliatesProperty()
    {
        $affiliates = HeaderAffiliate::where('header_city_id', null)
            ->get();

        return $affiliates;
    }

    public function render()
    {
        return view('livewire.admin.settings.edit-footer');
    }
}
