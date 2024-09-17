<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Doctor $doctor;

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaEducation = '';

    public string $enEducation = '';

    public string $ruEducation = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaSpecialty = '';

    public string $enSpecialty = '';

    public string $ruSpecialty = '';

    public string $age = '';

    public $expirience = '';

    public $specializations;

    public $specialization;

    public $categories;

    public $category;

    public string $slug = '';

    public array $images = [];

    public $image;

    public $imageTemporary;

    public $newImage;

    public $newImageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Doctor $doctor = null)
    {
        $this->doctor = $doctor ?? new Doctor();

        $this->activeLocale = app()->getLocale();

        $this->slug = $this->doctor->slug ?? '';

        $this->age = $this->doctor->age ?? '';

        $this->expirience = $this->doctor->expirience ?? '';

        $translations = DoctorTranslation::where('doctor_id',
            $this->doctor->id)
            ->get()
            ->keyBy('locale');

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaSpecialty = $translations['ua']->specialty ?? '';
        $this->enSpecialty = $translations['en']->specialty ?? '';
        $this->ruSpecialty = $translations['ru']->specialty ?? '';

        $this->uaEducation = $translations['ua']->education ?? '';
        $this->enEducation = $translations['en']->education ?? '';
        $this->ruEducation = $translations['ru']->education ?? '';

        $this->uaDescription = $translations['ua']->content ?? '';
        $this->enDescription = $translations['en']->content ?? '';
        $this->ruDescription = $translations['ru']->content ?? '';

        foreach($this->doctor->images ?? [] as $image) {
            $this->images[] = [
                'image' => $image,
                'imageUrl' => Storage::disk('public')->url($image),
            ];
        }

        $this->specializations = Specialization::get();

        $this->specialization = $this->doctor->specialization_id ?? null;

        $this->categories = DoctorCategory::get();

        $this->category = $this->doctor->doctor_category_id ?? null;
    }

    public function updatedNewImage($val)
    {
        $this->validate([
            'newImage' => 'required|image',
        ]);

        $this->newImage = null;

        $this->images[] = [
            'image' => $val,
            'imageUrl' => $val->temporaryUrl(),
        ];
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

            'uaEducation' => [
                'required',
                'string',
            ],

            'enEducation' => [
                'required',
                'string',
            ],

            'ruEducation' => [
                'required',
                'string',
            ],

            'uaSpecialty' => [
                'required',
                'string',
            ],

            'enSpecialty' => [
                'required',
                'string',
            ],

            'ruSpecialty' => [
                'required',
                'string',
            ],

            'uaDescription' => [
                'required',
                'string',
            ],

            'enDescription' => [
                'required',
                'string',
            ],

            'ruDescription' => [
                'required',
                'string',
            ],

            'expirience' => [
                'required',
                'string',
            ],

            'age' => [
                'required',
                'string',
            ],

            'slug' => [
                'required',
                'string',
                'unique:doctors,slug,' . ($this->doctor->id ?? '')
            ],

            'image' => [
                empty($this->doctor->id) ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],
        ];
    }

    public function updatedImage($val)
    {
        $this->validateOnly('image');
        $this->image = $val;
        $this->imageTemporary = $val->temporaryUrl();
    }

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/doctor', $file);

        return $image;
    }

    public function deleteStorageImage($image)
    {
        if ($image && $this->doctor->image) {
            Storage::disk('public')->delete($this->doctor->image);
        }
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        if($this->image) {
            $image = $this->downloadImage($this->image);

            $this->deleteStorageImage($image);

            $this->doctor->image = $image;
        }

        $images = [];

        foreach($this->images as $image2) {
            if(!in_array($image2['image'], $this->doctor->images ?? [])) {
                $images[] = $this->downloadImage($image2['image']);
            } else {
                $images[] = $image2['image'];
            }
        }

        foreach($this->doctor->images ?? [] as $image3) {
            if(!in_array($image3, $images)) {
                $this->deleteAdditionalImage($image3);
            }
        }

        $this->doctor->slug = $this->slug;

        $this->doctor->images = $images;

        $this->doctor->age = $this->age;

        $this->doctor->expirience = $this->expirience;

        $this->doctor->specialization_id = $this->specialization;

        $this->doctor->doctor_category_id = $this->category;

        $this->doctor->save();

        $locales = ['ua', 'en', 'ru'];

        $titles = [
            'ua' => $this->uaTitle,
            'en' => $this->enTitle,
            'ru' => $this->ruTitle,
        ];

        $descriptions = [
            'ua' => $this->uaDescription,
            'en' => $this->enDescription,
            'ru' => $this->ruDescription,
        ];

        $educations = [
            'ua' => $this->uaEducation,
            'en' => $this->enEducation,
            'ru' => $this->ruEducation,
        ];

        $specialties = [
            'ua' => $this->uaSpecialty,
            'en' => $this->enSpecialty,
            'ru' => $this->ruSpecialty,
        ];

        foreach ($locales as $locale) {
            DoctorTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'doctor_id' => $this->doctor->id,
                ],
                [
                    'title' => $titles[$locale],
                    'content' => $descriptions[$locale],
                    'specialty' => $specialties[$locale],
                    'education' => $educations[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.doctors.index');
    }

    public function deleteNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function deleteAdditionalImage($image)
    {
        if(Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.create-edit');
    }
}
