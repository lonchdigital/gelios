<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Services\Admin\FooterHeaderService;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditFooterHeader extends Component
{
    use WithFileUploads;

    public string $activeLocale;

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $facebook = '';

    public string $inst = '';

    public string $youtube = '';

    public Setting $headImage;

    public Setting $footImage;

    public $footerImage;

    public $footerImageTemporary;

    public $headerImage;

    public $headerImageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount()
    {
        $this->activeLocale = app()->getLocale();
        $this->loadValues();
    }

    public function loadValues()
    {
        $service = resolve(FooterHeaderService::class);

        $values = $service->loadSettings();

        $description = $values->where('key', 'footer_description')->first();

        $this->uaDescription = $description->translate('ua')->text ?? '';
        $this->enDescription = $description->translate('en')->text ?? '';
        $this->ruDescription = $description->translate('ru')->text ?? '';

        $this->headImage = $values->where('key', 'header_image')->first();
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

            'headerImage' => [
                'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],

            'footerImage' => [
                'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],
        ];
    }

    public function updatedHeaderImage($val)
    {
        $this->validateOnly('headerImage');
        $this->headerImage = $val;
        $this->headerImageTemporary = $val->temporaryUrl();
    }

    public function updatedFooterImage($val)
    {
        $this->validateOnly('footerImage');
        $this->footerImage = $val;
        $this->footerImageTemporary = $val->temporaryUrl();
    }

    public function deleteHeaderImage()
    {
        $this->headerImage = null;
        $this->headerImageTemporary = null;
    }

    public function deleteFooterImage()
    {
        $this->footerImage = null;
        $this->footerImageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        $this->saveImages();

        $this->saveDescription();

        $this->saveSocials();

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.header-footer.edit');
    }

    public function saveImages()
    {
        $imageService = resolve(ImageService::class);

        if ($this->headerImage) {
            $image = $imageService->downloadImage($this->headerImage, '/settings');

            if (!empty($this->headImage->value)) {
                $imageService->deleteStorageImage($image, $this->headImage->value);
            }

            Setting::where('key', 'header_image')->first()->update([
                'value' => $image,
            ]);
        }

        if ($this->footerImage) {
            $image = $imageService->downloadImage($this->footerImage, '/settings');

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

    public function render()
    {
        return view('livewire.admin.settings.edit-footer-header');
    }
}
