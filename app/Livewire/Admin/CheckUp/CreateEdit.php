<?php

namespace App\Livewire\Admin\CheckUp;

use App\Models\CheckUp;
use App\Models\CheckUpTranslation;
use App\Models\PromotionTranslation;
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

        $this->uaTitle = CheckUpTranslation::where('locale', 'ua')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = CheckUpTranslation::where('locale', 'en')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = CheckUpTranslation::where('locale', 'ru')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->title ?? '';

        $this->uaDescription = CheckUpTranslation::where('locale', 'ua')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->description ?? '';

        $this->enDescription = CheckUpTranslation::where('locale', 'en')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->description ?? '';

        $this->ruDescription = CheckUpTranslation::where('locale', 'ru')
            ->where('check_up_id', $this->checkUp->id ?? null)
            ->first()
            ->description ?? '';
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

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/check-up', $file);

        if ($image && $this->checkUp->image) {
            Storage::disk('public')->delete($this->checkUp->image);
        }

        return $image;
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save()
    {
        $this->validate();
        
        if($this->image) {
            $image = $this->downloadImage($this->image);

            $this->checkUp->image = $image;
        }

        $this->checkUp->price = $this->price;

        $this->checkUp->new_price = $this->newPrice;

        $this->checkUp->save();

        CheckUpTranslation::updateOrCreate([
            'locale' => 'ua',
            'check_up_id' => $this->checkUp->id,
        ], [
            'title' => $this->uaTitle,
            'description' => $this->uaDescription,
        ]);

        CheckUpTranslation::updateOrCreate([
            'locale' => 'ru',
            'check_up_id' => $this->checkUp->id,
        ], [
            'title' => $this->ruTitle,
            'description' => $this->ruDescription,
        ]);

        CheckUpTranslation::updateOrCreate([
            'locale' => 'en',
            'check_up_id' => $this->checkUp->id,
        ], [
            'title' => $this->enTitle,
            'description' => $this->enDescription,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.check-ups.index');
    }

    public function render()
    {
        return view('livewire.admin.check-up.create-edit');
    }
}
