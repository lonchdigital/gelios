<?php

namespace App\Livewire\Admin\MainPage;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public PageBlock $block;

    public array $locales = [];

    public string $activeLocale;

    public string $uaTitle = '';

    public string $enTitle = '';

    public string $ruTitle = '';

    public string $uaDescription = '';

    public string $enDescription = '';

    public string $ruDescription = '';

    public string $uaContent = '';

    public string $enContent = '';

    public string $ruContent = '';

    public string $uaButtonName = '';

    public string $enButtonName = '';

    public string $ruButtonName = '';

    public string $link = '';

    public $image;

    public $imageTemporary;

    public array $images = [];

    public $newImage;

    public $newImageTemporary;

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(PageBlock $block)
    {
        $this->block = $block;

        $this->link = $this->block->url ?? '';

        $translations = PageBlockTranslation::where('page_block_id', $this->block->id)
            ->whereIn('locale', ['ua', 'en', 'ru'])
            ->get()
            ->keyBy('locale');

        $this->activeLocale = app()->getLocale();

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        $this->uaButtonName = $translations['en']->button ?? '';
        $this->enButtonName = $translations['en']->button ?? '';
        $this->ruButtonName = $translations['ru']->button ?? '';

        $this->uaContent = $translations['en']->content ?? '';
        $this->enContent = $translations['en']->content ?? '';
        $this->ruContent = $translations['ru']->content ?? '';

        foreach($this->doctor->images ?? [] as $image) {
            $this->images[] = [
                'image' => $image,
                'imageUrl' => Storage::disk('public')->url($image),
            ];
        }
    }

    public function rules()
    {
        return [
            'uaTitle' => [
                $this->isShowTitle() ? 'required' : 'nullable',
                'string',
            ],

            'enTitle' => [
                $this->isShowTitle() ? 'required' : 'nullable',
                'string',
            ],

            'ruTitle' => [
                $this->isShowTitle() ? 'required' : 'nullable',
                'string',
            ],

            'uaDescription' => [
                $this->isShowDescription() ? 'required' : 'nullable',
                'string',
            ],

            'enDescription' => [
                $this->isShowDescription() ? 'required' : 'nullable',
                'string',
            ],

            'ruDescription' => [
                $this->isShowDescription() ? 'required' : 'nullable',
                'string',
            ],

            'uaContent' => [
                $this->isShowContent() ? 'required' : 'nullable',
                'string',
            ],

            'enContent' => [
                $this->isShowContent() ? 'required' : 'nullable',
                'string',
            ],

            'ruContent' => [
                $this->isShowContent() ? 'required' : 'nullable',
                'string',
            ],

            'uaButtonName' => [
                $this->isShowButtonName() ? 'required' : 'nullable',
                'string',
            ],

            'enButtonName' => [
                $this->isShowButtonName() ? 'required' : 'nullable',
                'string',
            ],

            'ruButtonName' => [
                $this->isShowButtonName() ? 'required' : 'nullable',
                'string',
            ],

            'link' => [
                $this->isShowLink() ? 'required' : 'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png,gif',
                'image',
            ],
        ];
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

    protected $validationAttributes = [
        'enTitle' => 'title',
        'enTitle' => 'title',
        'ruTitle' => 'title',
    ];

    public function updatedImage($val)
    {
        $this->validateOnly('image');
        $this->image = $val;
        $this->imageTemporary = $val->temporaryUrl();
    }

    public function downloadImage($file)
    {
        $image = Storage::disk('public')->put('/pages', $file);

        if ($image && $this->block->image && Storage::disk('public')->exists($this->block->image)) {
            Storage::disk('public')->delete($this->block->image);
        }

        return $image;
    }

    public function deleteStorageImage($image)
    {
        if ($image && $this->doctor->image) {
            Storage::disk('public')->delete($this->doctor->image);
        }
    }

    public function languageSwitched($lang)
    {
        $this->activeLocale = $lang;
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->imageTemporary = null;
    }

    public function save()
    {
        $this->validate();

        $this->block->url = $this->link;

        if ($this->image) {
            $this->block->image = $this->downloadImage($this->image, $this->block->id);
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

        $this->block->images = $images;

        $this->block->save();

        $translations = [
            'ua' => [
                'title' => $this->uaTitle,
                'description' => $this->uaDescription,
                'content' => $this->uaContent,
                'button' => $this->uaButtonName,
            ],
            'en' => [
                'title' => $this->enTitle,
                'description' => $this->enDescription,
                'content' => $this->enContent,
                'button' => $this->enButtonName,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'description' => $this->ruDescription,
                'content' => $this->ruContent,
                'button' => $this->ruButtonName,
            ]
        ];

        foreach ($translations as $locale => $data) {
            PageBlockTranslation::updateOrCreate(
                ['page_block_id' => $this->block->id, 'locale' => $locale],
                $data
            );
        }

        session()->flash('message', 'Block successfully edited');

        return $this->redirectRoute('admin.main-page.show');
    }

    public function isShowTitle()
    {
        return $this->block->block == 'main'
            || $this->block->block == 'second'
            || $this->block->block == 'banner';
    }

    public function isShowDescription()
    {
        return $this->block->block == 'main' && $this->block->key == 'first'
            || $this->block->block == 'statistics'
            || $this->block->block == 'second' && in_array($this->block->key, [
                'first',
                'second',
                'third',
                'fourth',
            ])
            || $this->block->block == 'banner' && $this->block->key !== 'content';
    }

    public function isShowButtonName()
    {
        return $this->block->block == 'main' && $this->block->key == 'first'
        || $this->block->block == 'banner' && $this->block->key !== 'content';
    }

    public function isShowLink()
    {
        return $this->block->block == 'main' && $this->block->key == 'text' && $this->block->page->slug == 'podcasts';
    }

    public function isShowImage()
    {
        return $this->block->block == 'main' && $this->block->key !== 'first'
            || $this->block->block == 'second' && $this->block->key !== 'first'
            || $this->block->block == 'banner';
    }

    public function isShowImages()
    {
        return $this->block->block == 'main' && $this->block->key == 'first';
    }

    public function render()
    {
        return view('livewire.admin.main-page.edit');
    }
}
