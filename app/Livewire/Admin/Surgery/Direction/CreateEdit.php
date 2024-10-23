<?php

namespace App\Livewire\Admin\Surgery\Direction;

use App\Models\Surgery;
use App\Models\SurgeryTranslation;
use App\Services\Admin\Surgery\DirectionService;
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

        $service = resolve(DirectionService::class);
        $translations = $service->getSurgeryTranslations($this->surgery);

        $this->uaTitle = $translations['uaTitle'];
        $this->enTitle = $translations['enTitle'];
        $this->ruTitle = $translations['ruTitle'];
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

        $locales = [
            'ua' => $this->uaTitle,
            'ru' => $this->ruTitle,
            'en' => $this->enTitle,
        ];

        $service = resolve(DirectionService::class);
        $service->saveSurgery($this->surgery, $locales);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.index');
    }

    public function render()
    {
        return view('livewire.admin.surgery.direction.create-edit');
    }
}
