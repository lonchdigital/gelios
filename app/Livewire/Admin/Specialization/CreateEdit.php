<?php

namespace App\Livewire\Admin\Specialization;

use App\Models\Specialization;
use App\Models\SpecializationTranslation;
use App\Services\Admin\SpecializationService;
use Livewire\Component;

class CreateEdit extends Component
{
    public Specialization $specialization;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Specialization $specialization = null)
    {
        $this->specialization = $specialization ?? new Specialization();
        $this->activeLocale = app()->getLocale();

        $service = resolve(SpecializationService::class);

        $translations = $service->getTranslations($this->specialization->id);

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

        $service = resolve(SpecializationService::class);

        $locales = [
            'ua' => $this->uaTitle,
            'ru' => $this->ruTitle,
            'en' => $this->enTitle,
        ];

        $service->saveSpecialization($this->specialization, $locales);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.specializations.index');
    }

    public function render()
    {
        return view('livewire.admin.specialization.create-edit');
    }
}
