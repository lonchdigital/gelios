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

    public string $email = '';

    public string $hours = '';

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

        $this->hours = $this->laboratory->hours ?? '';

        $this->latitude = $this->laboratory->latitude ?? '';

        $this->longitude = $this->laboratory->longitude ?? '';

        $translations = LaboratoryTranslation::where('laboratory_id',
            $this->laboratory->id)
            ->get()
            ->keyBy('locale');

        $this->uaAddress = $translations['ua']->address ?? '';
        $this->enAddress = $translations['en']->address ?? '';
        $this->ruAddress = $translations['ru']->address ?? '';

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

            'phone' => [
                'required',
                'string',
            ],

            'email' => [
                'required',
                'string',
            ],

            'hours' => [
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

        $this->laboratory->hours = $this->hours;

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

        foreach ($locales as $locale) {
            LaboratoryTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'laboratory_id' => $this->laboratory->id,
                ],
                [
                    'address' => $addresses[$locale],
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
