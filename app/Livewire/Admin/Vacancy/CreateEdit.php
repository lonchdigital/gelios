<?php

namespace App\Livewire\Admin\Vacancy;

use App\Models\Vacancy;
use App\Models\VacancyTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\Vacancy\VacancyService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Vacancy $vacancy;

    public string $activeLocale;

    public string $description;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Vacancy $vacancy = null)
    {
        $this->dispatch('livewire:load');

        $this->vacancy = $vacancy ?? new Vacancy();

        $this->activeLocale = config('app.active_lang');

        $this->loadTranslations();

        // $translations = VacancyTranslation::where('vacancy_id',
        //     $this->vacancy->id)
        //     ->get()
        //     ->keyBy('locale');

        // $this->uaTitle = $translations['ua']->title ?? '';
        // $this->enTitle = $translations['en']->title ?? '';
        // $this->ruTitle = $translations['ru']->title ?? '';

        // $this->uaDescription = $translations['ua']->description ?? '';
        // $this->enDescription = $translations['en']->description ?? '';
        // $this->ruDescription = $translations['ru']->description ?? '';
    }

    public function loadTranslations()
    {
        $service = resolve(VacancyService::class);

        $translations = $service->getTranslations($this->vacancy);

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';
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

            'image' => [
                empty($this->vacancy->id) ? 'required' : 'nullable',
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

    public function save()
    {
        $this->validate();

        $imageService = resolve(ImageService::class);

        if($this->image) {
            $image = $imageService->downloadImage($this->image, '/vacancy');

            if(!empty($this->vacancy->id) && !empty($this->vacancy->image)) {
                $imageService->deleteStorageImage($this->image, $this->vacancy->image);
            }

            $this->vacancy->image = $image;
        }

        $this->vacancy->save();

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

        foreach ($locales as $locale) {
            VacancyTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'vacancy_id' => $this->vacancy->id,
                ],
                [
                    'title' => $titles[$locale],
                    'description' => $descriptions[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.vacancies.index');
    }

    public function render()
    {
        return view('livewire.admin.vacancy.create-edit');
    }
}
