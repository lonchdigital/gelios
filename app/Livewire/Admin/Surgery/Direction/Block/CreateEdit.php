<?php

namespace App\Livewire\Admin\Surgery\Direction\Block;

use App\Models\Surgery;
use App\Models\SurgeryBlock;
use App\Models\SurgeryBlockTranslation;
use App\Services\Admin\ImageService;
use App\Services\Admin\Surgery\DirectionBlockService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public Surgery $surgery;

    public SurgeryBlock $block;

    public string $activeLocale;

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public $image;

    public $imageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(Surgery $surgery, SurgeryBlock $block = null)
    {
        $this->surgery = $surgery;

        $this->block = $block ?? new SurgeryBlock();

        $this->activeLocale = app()->getLocale();

        $service = resolve(DirectionBlockService::class);
        $translations = $service->getTranslations($this->block);

        $this->uaDescription = $translations['ua'];
        $this->enDescription = $translations['en'];
        $this->ruDescription = $translations['ru'];
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function rules()
    {
        return [
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
            $image = $imageService->downloadImage($this->image, '/surgery');

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

        $service = resolve(DirectionBlockService::class);
        $service->saveSurgeryBlock($this->block, $this->surgery->id, $descriptions);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.show', ['surgery' => $this->surgery]);
    }

    public function render()
    {
        return view('livewire.admin.surgery.direction.block.create-edit');
    }
}
