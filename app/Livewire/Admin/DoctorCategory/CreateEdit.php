<?php

namespace App\Livewire\Admin\DoctorCategory;

use App\Enums\DoctorCategoryType;
use App\Models\DoctorCategory;
use App\Models\DoctorCategoryTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public DoctorCategory $category;

    public string $activeLocale;

    public array $types = [];

    public string $type;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';
    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(DoctorCategory $category = null)
    {
        $this->category = $category ?? new DoctorCategory();

        $this->activeLocale = config('app.active_lang');

        $this->uaTitle = DoctorCategoryTranslation::where('locale', 'ua')
            ->where('doctor_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->enTitle = DoctorCategoryTranslation::where('locale', 'en')
            ->where('doctor_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->ruTitle = DoctorCategoryTranslation::where('locale', 'ru')
            ->where('doctor_category_id', $this->category->id ?? null)
            ->first()
            ->title ?? '';

        $this->types = [
            DoctorCategoryType::ADULT->value,
            DoctorCategoryType::CHILDREN->value,
        ];

        $this->type = $this->category->type ?? DoctorCategoryType::ADULT->value;
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

            'type' => [
                'required',
                'string',
                'in:adult,children'
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->category->type = $this->type;

        $this->category->save();

        DoctorCategoryTranslation::updateOrCreate([
            'locale' => 'ua',
            'doctor_category_id' => $this->category->id,
        ], [
            'title' => $this->uaTitle,
        ]);

        DoctorCategoryTranslation::updateOrCreate([
            'locale' => 'ru',
            'doctor_category_id' => $this->category->id,
        ], [
            'title' => $this->ruTitle,
        ]);

        DoctorCategoryTranslation::updateOrCreate([
            'locale' => 'en',
            'doctor_category_id' => $this->category->id,
        ], [
            'title' => $this->enTitle,
        ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.doctor-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.doctor-category.create-edit');
    }
}
