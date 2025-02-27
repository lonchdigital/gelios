<?php

namespace App\Livewire\Admin\Laboratory\Price;

use App\Models\LaboratoryCityTranslation;
use App\Models\LabPriceCategory;
use App\Models\LabPriceCategoryTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public LabPriceCategory $category;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched',
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function mount(LabPriceCategory $category = null)
    {
        $this->category = $category ?? new LabPriceCategory();

        $this->activeLocale = config('app.active_lang');

        $this->uaTitle = LabPriceCategoryTranslation::where('locale', 'ua')
            ->where('lab_price_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = LabPriceCategoryTranslation::where('locale', 'en')
            ->where('lab_price_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = LabPriceCategoryTranslation::where('locale', 'ru')
            ->where('lab_price_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';
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
        ];
    }

    public function save()
    {
        $this->validate();

        $this->category->save();

        LabPriceCategoryTranslation::updateOrCreate([
            'locale' => 'ua',
            'lab_price_category_id' => $this->category->id,
        ], [
            'title' => $this->uaTitle,
        ]);

        LabPriceCategoryTranslation::updateOrCreate([
            'locale' => 'ru',
            'lab_price_category_id' => $this->category->id,
        ], [
            'title' => $this->ruTitle,
        ]);

        LabPriceCategoryTranslation::updateOrCreate([
            'locale' => 'en',
            'lab_price_category_id' => $this->category->id,
        ], [
            'title' => $this->enTitle,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.laboratories.prices.edit', ['category' => $this->category]);
    }

    public function deleteItem($id, $type)
    {
        $this->dispatch('openModalDeleteItem', $type, $id);
    }

    public function refreshItemsAfterDelete()
    {
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.admin.laboratory.price.create-edit');
    }
}
