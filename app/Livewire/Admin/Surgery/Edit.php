<?php

namespace App\Livewire\Admin\Surgery;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorTranslation;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Models\Specialization;
use App\Services\Admin\ImageService;
use App\Services\Admin\Surgery\SurgeryService;
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

    protected $listeners = [
        'languageSwitched' => 'languageSwitched'
    ];

    public function mount(PageBlock $block)
    {
        $this->block = $block;

        $this->link = $this->block->url ?? '';

        $this->loadTranslations();

        $this->activeLocale = config('app.active_lang');
    }

    private function loadTranslations()
    {
        $service = resolve(SurgeryService::class);

        $translations = $service->getTranslations($this->block->id);

        $this->uaTitle = $translations['ua']->title ?? '';
        $this->enTitle = $translations['en']->title ?? '';
        $this->ruTitle = $translations['ru']->title ?? '';

        $this->uaDescription = $translations['ua']->description ?? '';
        $this->enDescription = $translations['en']->description ?? '';
        $this->ruDescription = $translations['ru']->description ?? '';

        $this->uaButtonName = $translations['ua']->button_name ?? '';
        $this->enButtonName = $translations['en']->button_name ?? '';
        $this->ruButtonName = $translations['ru']->button_name ?? '';

        $this->uaContent = $translations['ua']->content ?? '';
        $this->enContent = $translations['en']->content ?? '';
        $this->ruContent = $translations['ru']->content ?? '';
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

        $this->saveImage();

        $this->saveBlock();

        session()->flash('message', 'Block successfully edited');

        return $this->redirectRoute('admin.surgery.index');
    }

    private function saveImage()
    {
        $imageService = resolve(ImageService::class);

        if ($this->image) {
            $image = $imageService->downloadImage($this->image, '/pages');

            if (!empty($this->block->id) && !empty($this->block->image)) {
                $imageService->deleteStorageImage($this->image, $this->block->image);
            }

            $this->block->image = $image;
        }
    }

    private function saveBlock()
    {
        $this->block->url = $this->link;
        $this->block->save();

        $translations = [
            'ua' => [
                'title' => $this->uaTitle,
                'description' => $this->uaDescription,
                'content' => $this->uaContent,
                'button_name' => $this->uaButtonName,
            ],
            'en' => [
                'title' => $this->enTitle,
                'description' => $this->enDescription,
                'content' => $this->enContent,
                'button_name' => $this->enButtonName,
            ],
            'ru' => [
                'title' => $this->ruTitle,
                'description' => $this->ruDescription,
                'content' => $this->ruContent,
                'button_name' => $this->ruButtonName,
            ],
        ];

        $service = resolve(SurgeryService::class);

        $service->saveTranslations($this->block->id, $translations);
    }

    public function isShowTitle()
    {
        return $this->block->block == 'header' && $this->block->page->slug !== 'cryptocases'
            || $this->block->block == 'statistics'
            || $this->block->block == 'how_works' && !in_array($this->block->key, [
                'first_image',
                'second_image'
            ])
            || $this->block->block == 'about_us'
            || $this->block->block == 'earn_money'
            || $this->block->block == 'team'
            || $this->block->block == 'counters'
            || $this->block->block == 'road_map'
            || $this->block->block == 'podcasts'
            || $this->block->block == 'reviews'
            || $this->block->block == 'blog'
            || $this->block->block == 'second_block'
            || $this->block->block == 'third_block'
            || $this->block->block == 'fourth_block'
            || $this->block->block == 'banner'
            || $this->block->block == 'token'
            || $this->block->block == 'last_block'
            || $this->block->block == 'counters'
            || $this->block->block == 'affiliate'
            || $this->block->block == 'refferal_block'
            || $this->block->block == 'pools'
            || $this->block->block == 'members'
            || $this->block->block == 'register'
            || $this->block->block == 'rating_table'
            || $this->block->block == 'main'
            || $this->block->block == 'static_blocks'
            || $this->block->block == 'contacts';
    }

    public function isShowDescription()
    {
        return $this->block->block == 'header' && $this->block->key !== 'logo'
            || $this->block->block == 'statistics'
            || $this->block->block == 'how_works' && !in_array($this->block->key, [
                'first_image',
                'second_image',
                'title',
                'first_token_image',
                'second_token_image',
            ])
            || $this->block->block == 'about_us'
            || $this->block->block == 'earn_money'
            || $this->block->block == 'team'
            || $this->block->block == 'counters'
            || $this->block->block == 'road_map' && $this->block->key == 'text'
            || $this->block->block == 'podcasts'
            || $this->block->block == 'reviews'
            || $this->block->block == 'blog'
            || $this->block->block == 'second_block'
            || $this->block->block == 'third_block' && $this->block->key == 'text'
            || $this->block->block == 'fourth_block'
            || $this->block->block == 'token' && !in_array($this->block->key, [
                'first_add_block',
                'second_add_block',
                'third_add_block'
            ])
            || $this->block->block == 'last_block'
            || $this->block->block == 'counters'
            || $this->block->block == 'affiliate'
            || $this->block->block == 'refferal_block'
            || $this->block->block == 'pools'
            || $this->block->block == 'members'
            || $this->block->block == 'register'
            || $this->block->block == 'rating_table'
            || $this->block->block == 'main' && !in_array($this->block->key, [
                'first',
                'second',
                'third',
                'fourth',
                'fifth'
            ])
            || $this->block->block == 'articles'
            || $this->block->block == 'contacts' && $this->block->key == 'text';
    }

    public function isShowContent()
    {
        return $this->block->block == 'token' && $this->block->key == 'text'
            || $this->block->block == 'pools' && $this->block->key == 'text'
            || $this->block->block == 'members'
            || $this->block->block == 'static_blocks';
    }

    public function isShowButtonName()
    {
        return $this->block->block == 'header' && $this->block->key == 'text'
            || $this->block->block == 'earn_money' && $this->block->key == 'text'
            || $this->block->block == 'road_map' && $this->block->key == 'text'
            || $this->block->block == 'podcasts'
            || $this->block->block == 'blog'
            || $this->block->block == 'refferal_block'
            || $this->block->block == 'members'
            || $this->block->block == 'register'
            || $this->block->block == 'main' && $this->block->key == 'text' && $this->block->page->slug == 'podcasts';
    }

    public function isShowLink()
    {
        return $this->block->block == 'main' && $this->block->key == 'text' && $this->block->page->slug == 'podcasts';
    }

    public function isShowImage()
    {
        return $this->block->block == 'header' && in_array($this->block->page->slug, ['/', 'cryptocases'])
            || $this->block->block == 'how_works' && in_array($this->block->key, [
                'first_image',
                'second_image',
                'first_token_image',
                'second_token_image'
            ])
            ||  $this->block->block == 'about_us'
            ||  $this->block->key == 'image'
            ||  $this->block->block == 'second_block'
            ||  $this->block->block == 'third_block'
            ||  $this->block->block == 'last_block'
            ||  $this->block->block == 'register'
            ||  $this->block->block == 'main' && $this->block->key == 'text' && in_array($this->block->page->slug, ['podcasts', 'roadmap'])
            ||  $this->block->block == 'banner_image';
    }

    public function render()
    {
        return view('livewire.admin.surgery.edit');
    }
}
