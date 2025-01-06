<?php

namespace App\Livewire\Admin\Hospital\Hospitals;

use Livewire\Component;
use App\Models\Hospital;
use App\Models\HospitalGallery;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Hospitals\HospitalsService;


class Edit extends Component
{
    use WithFileUploads;

    public Hospital|null $hospital = null;

    public array $sectionData = [];
    public array $gallery = [];

    
    protected HospitalsService $hospitalsService;
    
    public function mount() 
    {
        $this->hospitalsService = app(HospitalsService::class);
        $this->dispatch('livewire:load');

        // set text block
        $this->sectionData = $this->hospitalsService->setTextBlockData($this->hospital);
        
        // set gallery
        if(!is_null($this->hospital)) {
            $gallery = HospitalGallery::where('hospital_id', $this->hospital->id)->orderBy('sort', 'asc')->get();
        
            foreach($gallery as $galleryItem) {
                $this->gallery[] = [
                    'id' => $galleryItem->id,
                    'sort' => $galleryItem->sort,
                    'oldImage' => $galleryItem->image ?? '',
                    'newImage' => null,
                    'image' => $galleryItem->image
                ];
            }
            $this->gallery = makeUsort($this->gallery);
        } else {
            $this->gallery = [];
        }
        

    }

    public function hydrate()
    {
        $this->hospitalsService = app(HospitalsService::class);
    }
    
    public function updated($propertyName)
    {
        if (preg_match('/sectionData.media.newImage/', $propertyName)) {
            $this->handleSectionImage();
        }
        if (preg_match('/gallery\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForGallery($propertyName);
        }
    }

    protected function handleSectionImage()
    {
        $this->sectionData['media']['temporaryImage'] = $this->sectionData['media']['newImage']->temporaryUrl();
        
    }
    public function handleDisplayFields()
    {
        $this->sectionData['is_image'] = $this->sectionData['is_image'];
    }
    public function deleteSectionImage()
    {
        $this->sectionData['media']['image'] = null;
        $this->sectionData['media']['temporaryImage'] = null;
    }

    public function newPositionGallery($val, $index)
    {
        $this->gallery[$index + $val]['sort'] = $this->gallery[$index]['sort'];

        $this->gallery[$index]['sort'] = $this->gallery[$index]['sort'] + $val;

        $this->gallery = makeUsort($this->gallery);
    }
    protected function handleImageChangeForGallery($propertyName)
    {
        preg_match('/gallery\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->gallery[$index]['temporaryImage'] = $this->gallery[$index]['newImage']->temporaryUrl();
    }
    public function deleteImageGallery($index)
    {
        $this->gallery[$index]['image'] = null;
        $this->gallery[$index]['temporaryImage'] = null;
    }
    public function removeElementGallery($index)
    {
        foreach($this->gallery as $index2 => $galleryItem) {
            if($galleryItem['sort'] > $this->gallery[$index]['sort']) {
                $this->gallery[$index2]['sort'] = $galleryItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->gallery)) {
            unset($this->gallery[$index]);
        }
    }
    public function addElementGallery()
    {
        $this->gallery[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->gallery) + 1,
        ];
    }

    protected function rules()
    {
        $rules = [];

        $rules['sectionData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionData.is_image'] = [
            'boolean'
        ];

        $rules['gallery'] = [
            'array'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['sectionData.name.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
        endforeach;

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $formData = [
            'image' => $this->sectionData['media'] ?? null,
            'name' => $this->sectionData['name'],
            'text_one' => $this->sectionData['text_one'],
            'text_two' => $this->sectionData['text_two'],
            'is_reverse' => $this->sectionData['is_reverse'],
            'is_image' => $this->sectionData['is_image'],
        ];
        $currentHospital = $this->hospitalsService->updateTextBlock($formData, $this->hospital);
        
        $existingGallery = HospitalGallery::where('hospital_id', $currentHospital->id)->get();
        $this->hospitalsService->syncGallery($this->gallery, $existingGallery, $currentHospital->id);

        redirect()->route('hospitals.index')->with('success', trans('admin.added_hospital_stationary'));
    }

    public function render()
    {
        return view('livewire.admin.hospital.hospitals.edit');
    }

}
