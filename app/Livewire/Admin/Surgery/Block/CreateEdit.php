<?php

namespace App\Livewire\Admin\Surgery\Block;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\Surgery\BlockService;
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

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $link = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(PageBlock $block = null)
    {
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::SURGERY->value)->first();
        $this->block = $block ?? new PageBlock();
        $this->activeLocale = config('app.active_lang');
        $this->link = $this->block->url ?? '';

        $service = resolve(BlockService::class);
        $translations = $service->getTranslations($this->block);

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['ua']->title ?? '';
        $this->ruTitle = $translations['ua']->title ?? '';
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
            'ua' => $this->uaDescription,
            'en' => $this->enDescription,
            'ru' => $this->ruDescription,
        ];

        $titles = [
            'ua' => $this->uaTitle,
            'en' => $this->enTitle,
            'ru' => $this->ruTitle,
        ];

        $data = [
            'page_id' => $this->page->id,
        ];

        $service = resolve(BlockService::class);

        $service->saveBlock(
            $this->block,
            $data,
            $descriptions,
            $titles,
            $this->block->block ?? 'static_block',
            $this->block->key ?? 'content',
            $this->link,
        );

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.index');
    }

    public function render()
    {
        return view('livewire.admin.surgery.block.create-edit');
    }
}
