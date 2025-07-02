<?php

namespace App\Livewire\Admin\Laboratory\Price\Item;

use App\Models\LaboratoryCityTranslation;
use App\Models\LabPriceCategory;
use App\Models\LabPriceCategoryTranslation;
use App\Models\LabPriceItem;
use App\Models\LabPriceItemTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public LabPriceCategory $category;

    public array $validationAttributes = [];

    public LabPriceItem $item;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaPrice = '';

    public string $enPrice = '';

    public string $ruPrice = '';

    public bool $is_free = false;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(LabPriceCategory $category, LabPriceItem $item = null)
    {
        $this->category = $category ?? new LabPriceCategory();

        $this->item = $item ?? new LabPriceItem();

        $this->is_free = $this->item->is_free ?? false;

        $this->activeLocale = config('app.active_lang');

        $this->uaTitle = LabPriceItemTranslation::where('locale', 'ua')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = LabPriceItemTranslation::where('locale', 'en')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = LabPriceItemTranslation::where('locale', 'ru')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->title ?? '';

        $this->uaPrice = LabPriceItemTranslation::where('locale', 'ua')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->price ?? '';

        $this->enPrice = LabPriceItemTranslation::where('locale', 'en')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->price ?? '';

        $this->ruPrice = LabPriceItemTranslation::where('locale', 'ru')
            ->where('lab_price_item_id', $this->item->id ?? null)
            ->first()
            ->price ?? '';

        $this->validationAttributes = [
            'uaTitle' => trans('validation.uaTitle'),
            'enTitle' => trans('validation.enTitle'),
            'ruTitle' => trans('validation.ruTitle'),
            'uaPrice' => trans('validation.uaPrice'),
            'enPrice' => trans('validation.enPrice'),
            'ruPrice' => trans('validation.ruPrice'),
        ];
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

            'is_free' => [
                // 'nullable',
                'boolean',
            ]
        ];
    }

    public function save()
    {
        $this->validate();

        $this->item->lab_price_category_id = $this->category->id;

        $this->item->is_free = $this->is_free;

        $this->item->save();

        LabPriceItemTranslation::updateOrCreate([
            'locale' => 'ua',
            'lab_price_item_id' => $this->item->id,
        ], [
            'title' => $this->uaTitle,
            'price' => $this->uaPrice,
        ]);

        LabPriceItemTranslation::updateOrCreate([
            'locale' => 'ru',
            'lab_price_item_id' => $this->item->id,
        ], [
            'title' => $this->ruTitle,
            'price' => $this->ruPrice,
        ]);

        LabPriceItemTranslation::updateOrCreate([
            'locale' => 'en',
            'lab_price_item_id' => $this->item->id,
        ], [
            'title' => $this->enTitle,
            'price' => $this->enPrice,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.laboratories.prices.edit', ['category' => $this->category]);
    }

    public function render()
    {
        return view('livewire.admin.laboratory.price.item.create-edit');
    }
}
