<?php

namespace App\Livewire\Admin\Settings\Affiliate;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\HeaderAffiliate;
use App\Models\HeaderAffiliateTranslation;
use App\Models\HeaderCity;
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

    public HeaderAffiliate $affiliate;

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

    public $city;

    public string $firstPhone = '';

    public string $secondPhone = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(HeaderCity $city = null, HeaderAffiliate $affiliate = null)
    {
        $this->affiliate = $affiliate ?? new HeaderAffiliate();

        $this->city = $city->id ?? null;

        $this->activeLocale = config('app.active_lang');

        $this->email = $this->affiliate->email ?? '';

        $this->firstPhone = $this->affiliate->first_phone ?? '';

        $this->secondPhone = $this->affiliate->second_phone ?? '';

        $this->latitude = $this->affiliate->latitude ?? '';

        $this->longitude = $this->affiliate->longitude ?? '';

        $translations = HeaderAffiliateTranslation::where('header_affiliate_id',
            $this->affiliate->id ?? null)
            ->get()
            ->keyBy('locale');

        $this->uaAddress = $translations['ua']->address ?? '';
        $this->enAddress = $translations['en']->address ?? '';
        $this->ruAddress = $translations['ru']->address ?? '';

        $this->uaHour = $translations['ua']->hours ?? '';
        $this->enHour = $translations['en']->hours ?? '';
        $this->ruHour = $translations['ru']->hours ?? '';
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

            'firstPhone' => [
                'nullable',
                'string',
            ],

            'secondPhone' => [
                'nullable',
                'string',
            ],

            'email' => [
                'required',
                'string',
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

        $this->affiliate->email = $this->email;

        $this->affiliate->first_phone = $this->firstPhone;

        $this->affiliate->second_phone = $this->secondPhone;

        $this->affiliate->header_city_id = $this->city;

        $this->affiliate->latitude = $this->latitude;

        $this->affiliate->longitude = $this->longitude;

        $this->affiliate->save();

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
            HeaderAffiliateTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'header_affiliate_id' => $this->affiliate->id,
                ],
                [
                    'address' => $addresses[$locale],
                    'hours' => $hours[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        if(!empty($this->city)) {
            $this->redirectRoute('admin.header.edit');
        } else {
            $this->redirectRoute('admin.footer.edit');
        }

    }

    public function render()
    {
        return view('livewire.admin.settings.affiliate.create-edit');
    }
}
