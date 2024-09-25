<?php

namespace App\Livewire\Admin\Surgery\Direction;

use App\Models\Surgery;
use App\Models\SurgeryTranslation;
use Livewire\Component;

class CreateEdit extends Component
{
    public Surgery $surgery;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Surgery $surgery = null)
    {
        $this->surgery = $surgery ?? new Surgery();
        $this->activeLocale = app()->getLocale();

        $translations = SurgeryTranslation::where('surgery_id',
                $this->surgery->id)
            ->get()
            ->keyBy('locale');

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';
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

        $this->surgery->save();

        $locales = [
            'ua' => $this->uaTitle,
            'ru' => $this->ruTitle,
            'en' => $this->enTitle
        ];

        foreach ($locales as $locale => $title) {
            SurgeryTranslation::updateOrCreate([
                'locale' => $locale,
                'surgery_id' => $this->surgery->id,
            ], [
                'title' => $title,
            ]);
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.index');
    }


    public function render()
    {
        return view('livewire.admin.surgery.direction.create-edit');
    }
}
