<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Direction;
use App\Models\DirectionDoctor;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorSpecialization;
use App\Models\DoctorTranslation;
use App\Models\Specialization;
use App\Services\Admin\DoctorService;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Specializable;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Doctor $doctor;

    public string $activeLocale;

    public string $description;

    public string $education;

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

    public string $seoDescription;

    public string $uaSeoTitle = '';

    public string $enSeoTitle = '';

    public string $ruSeoTitle = '';

    public string $uaSeoDescription = '';

    public string $enSeoDescription = '';

    public string $ruSeoDescription = '';


    // public $specializations;

    // public $specialization;

    public $specializations;

    public array $selectedSpecializations = [];

    public string $searchSpecialization = '';

    public $categories;

    public $category;

    public string $slug = '';

    public array $images = [];

    public $image;

    public $imageTemporary;

    public $newImage;

    public $newImageTemporary;

    public $directions;

    public array $selectedArray = [];

    public string $searchDirection = '';

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
        // $this->specialization = $this->doctor->specialization_id ?? null;

        $this->categories = DoctorCategory::get();
        $this->category = $this->doctor->doctor_category_id ?? null;

        foreach ($this->doctor->directions ?? [] as $direction) {
            $this->selectedArray[] = $direction;
        }

        $ids = [];

        foreach ($this->selectedArray as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->directions = Direction::whereNotIn('id', $ids)->take(5)->get();

        foreach ($this->doctor->specializations ?? [] as $specialization) {
            $this->selectedSpecializations[] = $specialization;
        }

        $ids2 = [];

        foreach ($this->selectedSpecializations as $item) {
            $ids2[] = $item->id ?? $item['id'];
        }

        $this->specializations = Specialization::whereNotIn('id', $ids)->take(5)->get();
    }

    private function loadImages()
    {
        $service = resolve(DoctorService::class);

        $this->images = $service->getDoctorImages($this->doctor);
    }

    public function updatedSearchDirection($val)
    {
        $ids = [];

        foreach ($this->selectedArray as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->directions = Direction::search(rtrim($val))
            ->whereNotIn('id', $ids)
            ->take(5)
            ->get();
    }

    public function updatedSearchSpecialization($val)
    {
        $ids = [];

        foreach ($this->selectedSpecializations as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->specializations = Specialization::search(rtrim($val))
            ->whereNotIn('id', $ids)
            ->take(5)
            ->get();
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

        $this->uaSeoDescription = $translations['ua']->meta_description ?? '';
        $this->enSeoDescription = $translations['en']->meta_description ?? '';
        $this->ruSeoDescription = $translations['ru']->meta_description ?? '';

        $this->uaSeoTitle = $translations['ua']->seo_title ?? '';
        $this->enSeoTitle = $translations['en']->seo_title ?? '';
        $this->ruSeoTitle = $translations['ru']->seo_title ?? '';
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
                'nullable',
                'string',
            ],

            'enSpecialty' => [
                'nullable',
                'string',
            ],

            'ruSpecialty' => [
                'nullable',
                'string',
            ],

            'uaDescription' => [
                'nullable',
                'string',
            ],

            'enDescription' => [
                'nullable',
                'string',
            ],

            'ruDescription' => [
                'nullable',
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

    public function updatedEducation($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaEducation = $val;
                break;
            case 'ru':
                $this->ruEducation = $val;
                break;
            case 'en':
                $this->enEducation = $val;
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
            $this->age,
            $this->expirience,
            // $this->specialization,
            $this->category ?? null,
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
            ],

            [
                'ua' => $this->uaSeoTitle,
                'en' => $this->enSeoTitle,
                'ru' => $this->ruSeoTitle,
            ],
            [
                'ua' => $this->uaSeoDescription,
                'en' => $this->enSeoDescription,
                'ru' => $this->ruSeoDescription,
            ],
        );

        $this->syncDirections();

        $this->syncSpecializations();

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.doctors.index');
    }

    public function syncDirections()
    {
        $ids = [];

        foreach ($this->selectedArray as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        foreach ($this->doctor->directions()->whereNotIn('directions.id', $ids)->get() as $deleteItem) {
            DirectionDoctor::where('direction_id', $deleteItem->id)
                ->where('doctor_id', $this->doctor->id)
                ->first()
                ->delete();
        }

        foreach ($this->selectedArray as $item) {
            DirectionDoctor::firstOrCreate([
                'doctor_id' => $this->doctor->id,
                'direction_id' => $item->id ?? $item['id'],
            ]);
        }
    }

    public function deleteItem($key)
    {
        unset($this->selectedArray[$key]);

        $ids = [];

        foreach ($this->selectedArray as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->directions = Direction::whereNotIn('id', $ids)->take(5)->get();
    }

    public function updatedSeoDescription($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaSeoDescription = $val;
                break;
            case 'ru':
                $this->ruSeoDescription = $val;
                break;
            case 'en':
                $this->enSeoDescription = $val;
                break;
        }
    }

    public function selectNetwork($id)
    {
        $direction = Direction::find($id);

        $this->searchDirection = $direction->name;

        $this->selectedArray[] = $direction;

        $ids = [];

        foreach ($this->selectedArray as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->directions = Direction::whereNotIn('id', $ids)->take(5)->get();

        $this->searchDirection = '';
    }


    public function deleteNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function syncSpecializations()
    {
        $ids = [];

        foreach ($this->selectedSpecializations as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        foreach ($this->doctor->specializations()->whereNotIn('specializations.id', $ids)->get() as $deleteItem) {
            DoctorSpecialization::where('specialization_id', $deleteItem->id)
                ->where('doctor_id', $this->doctor->id)
                ->first()
                ->delete();
        }

        foreach ($this->selectedSpecializations as $item) {
            DoctorSpecialization::firstOrCreate([
                'doctor_id' => $this->doctor->id,
                'specialization_id' => $item->id ?? $item['id'],
            ]);
        }
    }

    public function deleteSpecializationItem($key)
    {
        unset($this->selectedSpecializations[$key]);

        $ids = [];

        foreach ($this->selectedSpecializations as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->specializations = Specialization::whereNotIn('id', $ids)->take(5)->get();
    }

    public function selectSpecialization($id)
    {
        $specialization = Specialization::find($id);

        $this->searchSpecialization = $specialization->title;

        $this->selectedSpecializations[] = $specialization;

        $ids = [];

        foreach ($this->selectedSpecializations as $item) {
            $ids[] = $item->id ?? $item['id'];
        }

        $this->specializations = Specialization::whereNotIn('id', $ids)->take(5)->get();

        $this->searchSpecialization = '';
    }


    public function render()
    {
        return view('livewire.admin.doctor.create-edit');
    }
}
