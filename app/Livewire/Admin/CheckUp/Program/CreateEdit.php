<?php

namespace App\Livewire\Admin\CheckUp\Program;

use App\Models\CheckUp;
use App\Models\CheckUpProgram;
use App\Models\CheckUpProgramTranslation;
use App\Services\Admin\CheckUp\CreateEditService;
use Livewire\Component;

class CreateEdit extends Component
{
    public CheckUp $checkUp;

    public CheckUpProgram $program;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public array $options = [];

    protected $listeners = [
        'languageSwitched' => 'languageSwitched',
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function mount(CheckUp $checkUp, CheckUpProgram $program = null)
    {
        $this->checkUp = $checkUp;
        $this->program = $program ?? new CheckUpProgram();
        $this->activeLocale = config('app.active_lang');

        $translations = CheckUpProgramTranslation::where('check_up_program_id', $this->program->id)->get()->keyBy('locale');

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $optionsUa = $translations['ua']->options ?? [];
        $optionsEn = $translations['en']->options ?? [];
        $optionsRu = $translations['ru']->options ?? [];

        $count = max(count($optionsUa), count($optionsEn), count($optionsRu));

        for ($i = 0; $i < $count; $i++) {
            $this->options[] = [
                'ua' => $optionsUa[$i] ?? '',
                'en' => $optionsEn[$i] ?? '',
                'ru' => $optionsRu[$i] ?? '',
            ];
        }
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function addOption()
    {
        $this->options[] = [
            'ua' => '',
            'en' => '',
            'ru' => '',
        ];
    }

    public function deleteOption($key)
    {
        if (isset($this->options[$key])) {
            unset($this->options[$key]);
        }
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

            'options.*.ua' => [
                'required',
                'string',
            ],

            'options.*.en' => [
                'required',
                'string',
            ],

            'options.*.ru' => [
                'required',
                'string',
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->program->check_up_id = $this->checkUp->id;
        $this->program->save();

        $locales = ['ua', 'en', 'ru'];
        $titles = [
            'ua' => $this->uaTitle,
            'en' => $this->enTitle,
            'ru' => $this->ruTitle,
        ];

        $service = resolve(CreateEditService::class);

        $optionsArray = $service->prepareOptionsArray($this->options, $locales);

        $service = resolve(CreateEditService::class);

        $service->saveProgramTranslations($this->program, $locales, $titles, $optionsArray);

        session()->flash('success', 'Дані успішно збережено');

        return $this->redirectRoute('admin.check-ups.edit', ['checkUp' => $this->checkUp]);
    }

    public function render()
    {
        return view('livewire.admin.check-up.program.create-edit');
    }
}
