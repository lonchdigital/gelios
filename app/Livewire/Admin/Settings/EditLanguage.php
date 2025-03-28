<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EditLanguage extends Component
{

    public string $lang;


    protected $listeners = [
        'languageSwitched' => 'languageSwitched',
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->lang = app()->getLocale();
    }

    public function rules()
    {
        return [
            'lang' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function languageSwitched($lang)
    {
        // $this->activeLocale = $lang;
    }

    public function save()
    {
        $this->validate();

        Session::put('locale', $this->lang);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.language-settings.index');
    }

    public function getLanguagesProperty()
    {
        $locales = LaravelLocalization::getSupportedLocales();

        return $locales;
    }

    public function render()
    {
        return view('livewire.admin.settings.edit-language');
    }
}
