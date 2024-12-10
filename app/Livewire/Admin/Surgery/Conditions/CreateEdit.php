<?php

namespace App\Livewire\Admin\Surgery\Conditions;

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

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(PageBlock $block = null)
    {
        $this->page = Page::where('type', PageType::SURGERY->value)->first();
        $this->block = $block ?? new PageBlock();
        $this->activeLocale = config('app.active_lang');
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
            'image' => [
                empty($this->block->id) ? 'required' : 'nullable',
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
            'ua' => null,
            'en' => null,
            'ru' => null,
        ];

        $titles = [
            'ua' => null,
            'en' => null,
            'ru' => null,
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
            $this->block->block ?? 'conditions',
            $this->block->key ?? 'image',
            null,
        );

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.index');
    }

    public function render()
    {
        return view('livewire.admin.surgery.conditions.create-edit');
    }
}
