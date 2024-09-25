<?php

namespace App\Livewire\Admin\Surgery\Direction\Block;

use App\Models\Surgery;
use App\Models\SurgeryBlock;
use App\Models\SurgeryBlockTranslation;
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

        $translations = SurgeryBlockTranslation::where('surgery_block_id',
            $this->block->id)
            ->get()
            ->keyBy('locale');

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

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/surgery', $file);

        return $image;
    }

    public function deleteStorageImage($image)
    {
        if ($image && $this->block->image) {
            Storage::disk('public')->delete($this->block->image);
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

            $this->block->image = $image;
        }

        $this->block->surgery_id = $this->surgery->id;

        $this->block->save();

        $locales = ['ua', 'en', 'ru'];
        $descriptions = [
            'ua' => $this->uaDescription,
            'en' => $this->enDescription,
            'ru' => $this->ruDescription,
        ];

        foreach ($locales as $locale) {
            SurgeryBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'surgery_block_id' => $this->block->id,
                ],
                [
                    'description' => $descriptions[$locale],
                ]
            );
        }

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.surgery.show', ['surgery' => $this->surgery]);
    }

    public function render()
    {
        return view('livewire.admin.surgery.direction.block.create-edit');
    }
}
