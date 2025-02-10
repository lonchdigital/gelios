<?php

namespace App\Livewire\Admin\Laboratory;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\Laboratory;
use App\Models\LaboratoryCity;
use App\Models\LaboratoryTranslation;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Laboratory $laboratory;

    public string $activeLocale;

    public string $uaAddress = '';

    public string $enAddress = '';

    public string $ruAddress = '';

    public string $uaHour = '';

    public string $enHour = '';

    public string $ruHour = '';

    public string $email = '';

    public string $latitude = '';

    public string $longitude = '';

    public $cities;

    public $city;

    public string $phone = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Laboratory $laboratory = null)
    {
        $this->laboratory = $laboratory ?? new Laboratory();

        $this->activeLocale = config('app.active_lang');

        $this->email = $this->laboratory->email ?? '';

        $this->phone = $this->laboratory->phone ?? '';

        $this->latitude = $this->laboratory->latitude ?? '';

        $this->longitude = $this->laboratory->longitude ?? '';

        $translations = LaboratoryTranslation::where('laboratory_id',
            $this->laboratory->id)
            ->get()
            ->keyBy('locale');

        $this->uaAddress = $translations['ua']->address ?? '';
        $this->enAddress = $translations['en']->address ?? '';
        $this->ruAddress = $translations['ru']->address ?? '';

        $this->uaHour = $translations['ua']->hours ?? '';
        $this->enHour = $translations['en']->hours ?? '';
        $this->ruHour = $translations['ru']->hours ?? '';

        $this->cities = LaboratoryCity::get();

        $this->city = $this->laboratory->laboratory_city_id ?? null;
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'uaAddress' => [
                'required',
                'string',
            ],

            'enAddress' => [
                'required',
                'string',
            ],

            'ruAddress' => [
                'required',
                'string',
            ],

            'uaHour' => [
                'nullable',
                'string',
            ],

            'enHour' => [
                'nullable',
                'string',
            ],

            'ruHour' => [
                'nullable',
                'string',
            ],

            'phone' => [
                'required',
                'string',
            ],

            'email' => [
                'required',
                'string',
            ],

            'city' => [
                'required',
                'exists:laboratory_cities,id'
            ],

            'latitude' => [
                'string',
                'nullable',
                'max:191',
            ],

            'longitude' => [
                'string',
                'nullable',
                'max:191',
            ],
        ];
    }
    public function save()
    {
        $this->validate();

        $this->laboratory->email = $this->email;

        $this->laboratory->phone = $this->phone;

        $this->laboratory->laboratory_city_id = $this->city;

        $this->laboratory->latitude = $this->latitude;

        $this->laboratory->longitude = $this->longitude;

        $this->laboratory->save();

        $locales = ['ua', 'en', 'ru'];

        $addresses = [
            'ua' => $this->uaAddress,
            'en' => $this->enAddress,
            'ru' => $this->ruAddress,
        ];

        $hours = [
            'ua' => $this->uaHour,
            'en' => $this->enHour,
            'ru' => $this->ruHour,
        ];

        foreach ($locales as $locale) {
            LaboratoryTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'laboratory_id' => $this->laboratory->id,
                ],
                [
                    'address' => $addresses[$locale],
                    'hours' => $hours[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.laboratories.index');
    }

    public function render()
    {
        return view('livewire.admin.laboratory.create-edit');
    }
}
