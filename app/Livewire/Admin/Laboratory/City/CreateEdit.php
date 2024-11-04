<?php

namespace App\Livewire\Admin\Laboratory\City;

use App\Models\LaboratoryCity;
use App\Models\LaboratoryCityTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public LaboratoryCity $city;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(LaboratoryCity $city = null)
    {
        $this->city = $city ?? new LaboratoryCity();

        $this->activeLocale = config('app.active_lang');

        $this->uaTitle = LaboratoryCityTranslation::where('locale', 'ua')
            ->where('laboratory_city_id', $this->city->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = LaboratoryCityTranslation::where('locale', 'en')
            ->where('laboratory_city_id', $this->city->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = LaboratoryCityTranslation::where('locale', 'ru')
            ->where('laboratory_city_id', $this->city->id ?? null)
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

        $this->city->save();

        LaboratoryCityTranslation::updateOrCreate([
            'locale' => 'ua',
            'laboratory_city_id' => $this->city->id,
        ], [
            'title' => $this->uaTitle,
        ]);

        LaboratoryCityTranslation::updateOrCreate([
            'locale' => 'ru',
            'laboratory_city_id' => $this->city->id,
        ], [
            'title' => $this->ruTitle,
        ]);

        LaboratoryCityTranslation::updateOrCreate([
            'locale' => 'en',
            'laboratory_city_id' => $this->city->id,
        ], [
            'title' => $this->enTitle,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.laboratory-cities.index');
    }

    public function render()
    {
        return view('livewire.admin.laboratory.city.create-edit');
    }
}
