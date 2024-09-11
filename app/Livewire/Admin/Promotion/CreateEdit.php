<?php

namespace App\Livewire\Admin\Promotion;

use App\Models\Promotion;
use App\Models\PromotionTranslation;
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

        $this->uaTitle = PromotionTranslation::where('locale', 'ua')->where('promotion_id', $this->promotion->id ?? null)->first()->title ?? '';

        $this->enTitle = PromotionTranslation::where('locale', 'en')->where('promotion_id', $this->promotion->id ?? null)->first()->title ?? '';

        $this->ruTitle = PromotionTranslation::where('locale', 'ru')->where('promotion_id', $this->promotion->id ?? null)->first()->title ?? '';

        $this->uaDescription = PromotionTranslation::where('locale', 'ua')->where('promotion_id', $this->promotion->id ?? null)->first()->description ?? '';

        $this->enDescription = PromotionTranslation::where('locale', 'en')->where('promotion_id', $this->promotion->id ?? null)->first()->description ?? '';

        $this->ruDescription = PromotionTranslation::where('locale', 'ru')->where('promotion_id', $this->promotion->id ?? null)->first()->description ?? '';
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

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/promotions', $file);

        if ($image && $this->promotion->image) {
            Storage::disk('public')->delete($this->promotion->image);
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

            $this->promotion->image = $image;
        }

        $this->promotion->slug = $this->slug;

        $this->promotion->save();

        PromotionTranslation::updateOrCreate([
            'locale' => 'ua',
            'promotion_id' => $this->promotion->id,
        ], [
            'title' => $this->uaTitle,
            'description' => $this->uaDescription,
        ]);

        PromotionTranslation::updateOrCreate([
            'locale' => 'ru',
            'promotion_id' => $this->promotion->id,
        ], [
            'title' => $this->ruTitle,
            'description' => $this->ruDescription,
        ]);

        PromotionTranslation::updateOrCreate([
            'locale' => 'en',
            'promotion_id' => $this->promotion->id,
        ], [
            'title' => $this->enTitle,
            'description' => $this->enDescription,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.promotions.index');
    }

    public function render()
    {
        return view('livewire.admin.promotion.create-edit');
    }
}
