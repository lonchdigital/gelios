<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\Specialization;
use App\Services\Admin\DoctorService;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Doctor $doctor;

    public string $activeLocale;

    public string $description;

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

    public string $uaSlug = '';

    public string $enSlug = '';

    public string $ruSlug = '';

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
        $this->dispatch('livewire:load');

        $this->doctor = $doctor ?? new Doctor();

        $this->activeLocale = config('app.active_lang');
        $this->slug = $this->doctor->slug ?? '';
        $this->age = $this->doctor->age ?? '';
        $this->expirience = $this->doctor->expirience ?? '';

        $this->loadTranslations();
        $this->loadImages();

        $this->specializations = Specialization::get();
        $this->specialization = $this->doctor->specialization_id ?? null;

        $this->categories = DoctorCategory::get();
        $this->category = $this->doctor->doctor_category_id ?? null;
    }

    private function loadImages()
    {
        $service = resolve(DoctorService::class);

        $this->images = $service->getDoctorImages($this->doctor);
    }

    private function loadTranslations()
    {
        $service = resolve(DoctorService::class);

        $translations = $service->getDoctorTranslations($this->doctor);

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

        $this->uaSlug = $translations['ua']['slug'] ?? '';
        $this->enSlug = $translations['en']['slug'] ?? '';
        $this->ruSlug = $translations['ru']['slug'] ?? '';
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
                'nullable',
                'string',
            ],

            'age' => [
                'nullable',
                'string',
            ],

            'uaSlug' => [
                'required',
                'string',
                Rule::unique('doctor_translations', 'slug')->where(function ($query) {
                    return $query->where('doctor_id', '!=', $this->doctor->id);
                }),
            ],

            'ruSlug' => [
                'required',
                'string',
                Rule::unique('doctor_translations', 'slug')->where(function ($query) {
                    return $query->where('doctor_id', '!=', $this->doctor->id);
                }),
            ],

            'enSlug' => [
                'required',
                'string',
                Rule::unique('doctor_translations', 'slug')->where(function ($query) {
                    return $query->where('doctor_id', '!=', $this->doctor->id);
                }),
            ],



            'image' => [
                empty($this->doctor->id) ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],
        ];
    }

    public function updatedDescription($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaDescription = $val;
                break;
            case 'ru':
                $this->ruDescription = $val;
                break;
            case 'en':
                $this->enDescription = $val;
                break;
        }
    }

    public function updatedImage($val)
    {
        $this->validateOnly('image');
        $this->image = $val;
        $this->imageTemporary = $val->temporaryUrl();
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save(DoctorService $doctorService, ImageService $imageService)
    {
        $this->validate();

        $imageService = resolve(ImageService::class);

        if ($this->image) {
            $image = $imageService->downloadImage($this->image, '/doctor');

            if (!empty($this->doctor->id) && !empty($this->doctor->image)) {
                $imageService->deleteStorageImage($this->image, $this->doctor->image);
            }

            $this->doctor->image = $image;
        }

        $images = [];

        foreach ($this->images as $image2) {
            if (!in_array($image2['image'], $this->doctor->images ?? [])) {
                $images[] = $imageService->downloadImage($image2['image'], '/doctor');
            } else {
                $images[] = $image2['image'];
            }
        }

        foreach ($this->doctor->images ?? [] as $image3) {
            if (!in_array($image3, $images)) {
                $imageService->deleteAdditionalImage($image3);
            }
        }

        $doctorService->saveDoctor(
            $this->doctor,
            $this->slug,
            $this->age,
            $this->expirience,
            $this->specialization,
            $this->category,
            $images
        );

        $locales = ['ua', 'en', 'ru'];

        $doctorService->saveTranslations(
            $this->doctor,
            [
                'ua' => $this->uaTitle,
                'en' => $this->enTitle,
                'ru' => $this->ruTitle,
            ],
            [
                'ua' => $this->uaDescription,
                'en' => $this->enDescription,
                'ru' => $this->ruDescription,
            ],
            [
                'ua' => $this->uaSpecialty,
                'en' => $this->enSpecialty,
                'ru' => $this->ruSpecialty,
            ],
            [
                'ua' => $this->uaEducation,
                'en' => $this->enEducation,
                'ru' => $this->ruEducation,
            ],
            $locales,
            [
                'ua' => $this->uaSlug,
                'en' => $this->enSlug,
                'ru' => $this->ruSlug,
            ]
        );

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.doctors.index');
    }

    public function deleteNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.create-edit');
    }
}
