<?php

namespace App\Livewire\Admin\MainPage;

use App\Enums\PageType;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Models\PageTranslation;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Seo extends Component
{
    use WithFileUploads;

    public Page $page;

    public array $locales = [];

    public string $activeLocale;

    public string $seoDescription;

    public string $seoContent;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaMetaTitle = '';

    public string $enMetaTitle = '';

    public string $ruMetaTitle = '';

    public string $uaSeoTitle = '';

    public string $enSeoTitle = '';

    public string $ruSeoTitle = '';

    public string $uaSeoDescription = '';

    public string $enSeoDescription = '';

    public string $ruSeoDescription = '';

    public string $uaSeoContent = '';

    public string $enSeoContent = '';

    public string $ruSeoContent = '';

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Page $page)
    {
        $this->dispatch('livewire:load');

        $this->page = $page;

        $translations = PageTranslation::where('page_id', $this->page->id)
            ->whereIn('locale', ['ua', 'en', 'ru'])
            ->get()
            ->keyBy('locale');

        $this->activeLocale = config('app.active_lang');

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaMetaTitle = $translations['ua']->meta_title ?? '';
        $this->enMetaTitle = $translations['en']->meta_title ?? '';
        $this->ruMetaTitle = $translations['ru']->meta_title ?? '';

        $this->uaSeoDescription = $translations['ua']->meta_description ?? '';
        $this->enSeoDescription = $translations['en']->meta_description ?? '';
        $this->ruSeoDescription = $translations['ru']->meta_description ?? '';

        $this->uaSeoTitle = $translations['ua']->seo_title ?? '';
        $this->enSeoTitle = $translations['en']->seo_title ?? '';
        $this->ruSeoTitle = $translations['ru']->seo_title ?? '';

        $this->uaSeoContent = $translations['ua']->seo_text ?? '';
        $this->enSeoContent = $translations['en']->seo_text ?? '';
        $this->ruSeoContent = $translations['ru']->seo_text ?? '';
    }

    public function rules()
    {
        return [
            'uaTitle' => [
                'nullable',
                'string',
            ],

            'enTitle' => [
                'nullable',
                'string',
            ],

            'ruTitle' => [
                'nullable',
                'string',
            ],

            'uaSeoTitle' => [
                'nullable',
                'string',
            ],

            'enSeoTitle' => [
                'nullable',
                'string',
            ],

            'ruSeoTitle' => [
                'nullable',
                'string',
            ],

            'uaMetaTitle' => [
                'nullable',
                'string',
            ],

            'enMetaTitle' => [
                'nullable',
                'string',
            ],

            'ruMetaTitle' => [
                'nullable',
                'string',
            ],

            'uaSeoDescription' => [
                'nullable',
                'string',
            ],

            'enSeoDescription' => [
                'nullable',
                'string',
            ],

            'ruSeoDescription' => [
                'nullable',
                'string',
            ],

            'uaSeoContent' => [
                'nullable',
                'string',
            ],

            'enSeoContent' => [
                'nullable',
                'string',
            ],

            'ruSeoContent' => [
                'nullable',
                'string',
            ],
        ];
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

    public function updatedSeoContent($val)
    {
        switch ($this->activeLocale) {
            case 'ua':
                $this->uaSeoContent = $val;
                break;
            case 'ru':
                $this->ruSeoContent = $val;
                break;
            case 'en':
                $this->enSeoContent = $val;
                break;
        }
    }

    protected $validationAttributes = [
        'enTitle' => 'title',
        'enTitle' => 'title',
        'ruTitle' => 'title',
        'enSeoTitle' => 'meta title',
        'enSeoTitle' => 'meta title',
        'ruSeoTitle' => 'meta title',
        'enSeodescription' => 'meta description',
        'enSeodescription' => 'meta description',
        'ruSeodescription' => 'meta description',
    ];

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function save()
    {
        $this->validate();

        $this->page->save();

        $translations = [
            'ua' => [
                'title' => $this->uaTitle,
                'meta_title' => $this->uaMetaTitle,
                'meta_description' => $this->uaSeoDescription,
                'seo_title' => $this->uaSeoTitle,
                'seo_text' => $this->uaSeoContent,
            ],
            'en' => [
                'title' => $this->enTitle,
                'meta_title' => $this->uaMetaTitle,
                'meta_description' => $this->enSeoDescription,
                'seo_title' => $this->enSeoTitle,
                'seo_text' => $this->enSeoContent,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'meta_title' => $this->ruMetaTitle,
                'meta_description' => $this->ruSeoDescription,
                'seo_title' => $this->ruSeoTitle,
                'seo_text' => $this->ruSeoContent,
            ]
        ];

        foreach ($translations as $locale => $data) {
            PageTranslation::updateOrCreate(
                ['page_id' => $this->page->id, 'locale' => $locale],
                $data
            );
        }

        session()->flash('message', 'Main page seo successfully edited');

        switch ($this->page->type) {
            case 'main_page':
                    return $this->redirectRoute('admin.main-page.edit-seo');
                break;

            case 'laboratory':
                    return $this->redirectRoute('admin.laboratories.edit-main-seo');
                break;

            case 'one_laboratory':
                    return $this->redirectRoute('admin.laboratories.edit-one-page-seo');
                break;

            case 'shares':
                    return $this->redirectRoute('admin.promotions.edit-main-seo');
                break;

            case 'shares_item':
                    return $this->redirectRoute('admin.promotions.edit-one-page-seo');
                break;

            case 'check_up':
                    return $this->redirectRoute('admin.check-ups.edit-main-seo');
                break;

            case 'check_up_item':
                    return $this->redirectRoute('admin.check-ups.edit-one-page-seo');
                break;

            case 'blog':
                    return $this->redirectRoute('admin.articles.edit-main-seo');
                break;

            case 'article':
                    return $this->redirectRoute('admin.articles.edit-one-page-seo');
                break;

            case 'doctor':
                    return $this->redirectRoute('admin.doctors.edit-main-seo');
                break;

            case 'one_doctor':
                    return $this->redirectRoute('admin.doctors.edit-one-page-seo');
                break;

            case 'surgery':
                    return $this->redirectRoute('admin.surgery.edit-main-seo');
                break;

            case 'opening':
                    return $this->redirectRoute('admin.vacancies.edit-main-seo');
                break;

            default:
                return $this->redirectRoute('admin.main-page.edit-seo');
        }

    }

    public function render()
    {
        return view('livewire.admin.main-page.seo');
    }
}
