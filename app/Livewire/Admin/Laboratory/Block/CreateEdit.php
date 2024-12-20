<?php

namespace App\Livewire\Admin\Laboratory\Block;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Page $page;

    public PageBlock $block;

    public string $activeLocale;

    public string $description;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaButton = '';

    public string $enButton = '';

    public string $ruButton = '';

    public string $link = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Page $page, PageBlock $block = null)
    {
        $this->dispatch('livewire:load');

        $this->page = $page;
        $this->block = $block ?? new PageBlock();
        $this->activeLocale = config('app.active_lang');
        $this->link = $this->block->url ?? '';

        $service = resolve(BlockService::class);
        $translations = $service->getTranslations($this->block);

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        $this->uaButton = $translations['ua']->button ?? '';
        $this->enButton = $translations['en']->button ?? '';
        $this->ruButton = $translations['ru']->button ?? '';

        $this->block->block = $block->block ?? 'main';
        $this->block->key = $block->key ?? 'slider';
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
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

            'uaButton' => [
                'nullable',
                'string',
            ],

            'enButton' => [
                'nullable',
                'string',
            ],

            'ruButton' => [
                'nullable',
                'string',
            ],

            'link' => [
                'nullable',
                'string',
            ],

            'image' => [
                empty($this->block->id) ? 'required' : 'nullable',
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

        if ($this->image) {
            $image = $imageService->downloadImage($this->image, '/static-blocks');

            if (!empty($this->block->id) && !empty($this->block->image)) {
                $imageService->deleteStorageImage($this->image, $this->block->image);
            }

            $this->block->image = $image;
        }

        $descriptions = [
            'ua' => [
                'title' => $this->uaTitle,
                'description' => $this->uaDescription,
                'button' => $this->uaButton,
            ],
            'en' => [
                'title' => $this->enTitle,
                'description' => $this->enDescription,
                'button' => $this->enButton,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'description' => $this->ruDescription,
                'button' => $this->ruButton,
            ],
        ];

        $data = [
            'page_id' => $this->page->id,
            'link' => $this->link,
            'block' => $this->block->block,
            'key' => $this->block->key,
        ];

        $service = resolve(BlockService::class);

        $service->saveSlider($this->block, $data, $descriptions);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.laboratories.index');
    }

    public function render()
    {
        return view('livewire.admin.laboratory.slider.create-edit');
    }
}
