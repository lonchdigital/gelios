<?php

namespace App\Livewire\Admin\CheckUp\Program;

use App\Models\CheckUp;
use App\Models\CheckUpProgram;
use App\Models\CheckUpProgramTranslation;
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
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(CheckUp $checkUp, CheckUpProgram $program = null)
    {
        $this->checkUp = $checkUp;
        $this->program = $program ?? new CheckUpProgram();
        $this->activeLocale = app()->getLocale();

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
        $this->program->check_up_id = $this->checkUp->id;
        $this->program->save();

        $locales = ['ua', 'en', 'ru'];
        $titles = [
            'ua' => $this->uaTitle,
            'en' => $this->enTitle,
            'ru' => $this->ruTitle,
        ];

        $optionsArray = [
            'ua' => [],
            'en' => [],
            'ru' => []
        ];

        foreach ($this->options as $option) {
            foreach ($locales as $locale) {
                $optionsArray[$locale][] = $option[$locale] ?? '';
            }
        }

        foreach ($locales as $locale) {
            CheckUpProgramTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'check_up_program_id' => $this->program->id,
                ],
                [
                    'title' => $titles[$locale],
                    'options' => $optionsArray[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        return $this->redirectRoute('admin.check-ups.edit', ['checkUp' => $this->checkUp]);
    }


    public function render()
    {
        return view('livewire.admin.check-up.program.create-edit');
    }
}
