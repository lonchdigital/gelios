<?php

namespace App\Livewire\Admin\Directions\Templates;

use App\Models\Direction;
use App\Models\DirectionTextBlock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class Category extends Component
{
    use WithFileUploads;

    public Direction $direction;

    public array $сurrentDirectionData = [];

    public DirectionTextBlock|null $directionTextBlockOne = null;
    public DirectionTextBlock|null $directionTextBlockTwo = null;
    public DirectionTextBlock|null $directionTextBlockThree = null;

    public array $sectionOneData = [];
    public array $sectionTwoData = [];
    public array $sectionThreeData = [];

    public array $seoData = [];

    public array $directionContacts = [];
    public Collection $allDirectionContacts;

    protected DirectionsService $directionsService;
    
    public function mount() 
    {
        $this->directionsService = app(DirectionsService::class);
        $this->dispatch('livewire:load');

        $this->сurrentDirectionData = $this->directionsService->setCurrentDirectionData($this->direction);

        $this->allDirectionContacts = $this->directionsService->getAllOffices();

        // Set current direction contacts
        $this->directionContacts = $this->directionsService->setCurrentdirectionContacts($this->direction);

        // Set Section One data
        $this->directionTextBlockOne = DirectionTextBlock::where('number', 1)->where('direction_id', $this->direction->id)->first();
        $this->sectionOneData = $this->directionsService->setTextBlockData($this->directionTextBlockOne);

        // Set Section Two data
        $this->directionTextBlockTwo = DirectionTextBlock::where('number', 2)->where('direction_id', $this->direction->id)->first();
        $this->sectionTwoData = $this->directionsService->setTextBlockData($this->directionTextBlockTwo);
        
        // Set Section Three data
        $this->directionTextBlockThree = DirectionTextBlock::where('number', 3)->where('direction_id', $this->direction->id)->first();
        $this->sectionThreeData = $this->directionsService->setTextBlockData($this->directionTextBlockThree);

        // Set SEO data
        $this->seoData = $this->directionsService->setSeoData($this->direction->page);
    }

    public function hydrate()
    {
        $this->directionsService = app(DirectionsService::class);
    }
    
    public function updated($propertyName)
    {
        if (preg_match('/sectionOneData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(1);
        }
        if (preg_match('/sectionTwoData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(2);
        }
        if (preg_match('/sectionThreeData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(3);
        }
    }

    protected function handleSectionImage(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['media']['temporaryImage'] = $this->sectionOneData['media']['newImage']->temporaryUrl();
                break;
            case 2:
                $this->sectionTwoData['media']['temporaryImage'] = $this->sectionTwoData['media']['newImage']->temporaryUrl();
                break;
            case 3:
                $this->sectionThreeData['media']['temporaryImage'] = $this->sectionThreeData['media']['newImage']->temporaryUrl();
                break;
        }
        
    }
    public function handleDisplayFields(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['is_image'] = $this->sectionOneData['is_image'];
                break;
            case 2:
                $this->sectionTwoData['is_image'] = $this->sectionTwoData['is_image'];
                break;
            case 3:
                $this->sectionThreeData['is_image'] = $this->sectionThreeData['is_image'];
                break;
        }
    }

    public function deleteSectionImage(int $section)
    {
        switch ($section) {
            case 1:
                $this->sectionOneData['media']['image'] = null;
                $this->sectionOneData['media']['temporaryImage'] = null;
                break;
            case 2:
                $this->sectionTwoData['media']['image'] = null;
                $this->sectionTwoData['media']['temporaryImage'] = null;
                break;
            case 3:
                $this->sectionThreeData['media']['image'] = null;
                $this->sectionThreeData['media']['temporaryImage'] = null;
                break;
        }
    }

    protected function rules()
    {
        $rules = [];

        $rules['сurrentDirectionData.slug'] = [
            'required',
            'string',
            'unique:page_directions,slug,' . ($this->direction->page->id ?? '')
        ];

        return $rules;
    }

    protected function attributes()
    {
        $attributes = [];

        $attributes['сurrentDirectionData.slug'] = 'slug';

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    public function save()
    {
        $this->validate();

        $formDataOne = [
            'direction_id' => $this->direction->id,
            'number' => 1,
            'image' => $this->sectionOneData['media'] ?? null,
            'text_one' => $this->sectionOneData['text_one'],
            'text_two' => $this->sectionOneData['text_two'],
            'is_reverse' => $this->sectionOneData['is_reverse'],
            'is_image' => $this->sectionOneData['is_image'],
        ];
        $this->directionsService->updateTextBlock($formDataOne);

        $formDataTwo = [
            'direction_id' => $this->direction->id,
            'number' => 2,
            'image' => $this->sectionTwoData['media'] ?? null,
            'text_one' => $this->sectionTwoData['text_one'],
            'text_two' => $this->sectionTwoData['text_two'],
            'is_reverse' => $this->sectionTwoData['is_reverse'],
            'is_image' => $this->sectionTwoData['is_image'],
        ];
        $this->directionsService->updateTextBlock($formDataTwo);

        $formDataThree = [
            'direction_id' => $this->direction->id,
            'number' => 3,
            'image' => $this->sectionThreeData['media'] ?? null,
            'text_one' => $this->sectionThreeData['text_one'],
            'text_two' => $this->sectionThreeData['text_two'],
            'is_reverse' => $this->sectionThreeData['is_reverse'],
            'is_image' => $this->sectionThreeData['is_image'],
        ];
        $this->directionsService->updateTextBlock($formDataThree);

        $this->direction->contacts()->sync($this->directionContacts);

        // Update Direction
        $directionData = [
            'name' => $this->сurrentDirectionData['name'],
            'slug' => $this->сurrentDirectionData['slug'],
            'parent_id' => null
        ];
        $this->directionsService->updateDirection($this->direction, $directionData);

        // Update Direction Page
        $this->directionsService->updatePage($this->direction->page, $this->seoData, $directionData);

        redirect()->route('directions.edit', ['directionId' => $this->direction->id])->with('success', trans('admin.data_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.templates.category', ['direction' => $this->direction]);
    }

}