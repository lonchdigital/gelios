<?php

namespace App\Livewire\Admin\Directions\Templates;

use Livewire\Component;
use App\Models\Direction;
use App\Models\DirectionInfoBlock;
use App\Models\DirectionPrice;
use Livewire\WithFileUploads;
use App\Models\DirectionTextBlock;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class SubCategory extends Component
{
    use WithFileUploads;

    public Direction $direction;

    public array $сurrentDirectionData = [];

    public DirectionTextBlock|null $directionTextBlockOne = null;
    public DirectionTextBlock|null $directionTextBlockTwo = null;

    public array $sectionOneData = [];
    public array $sectionTwoData = [];

    public array $directionPrices = [];
    public array $infoData = [];

    public array $seoData = [];
    
    public int|null $directionParent = null;
    public array $directionContacts = [];
    public Collection $allDirectionContacts;
    public array $allDirections = [];
    protected DirectionsService $directionsService;
    
    public function mount() 
    {
        $this->directionsService = app(DirectionsService::class);
        $this->dispatch('livewire:load');

        $this->сurrentDirectionData = $this->directionsService->setCurrentDirectionData($this->direction);

        $this->allDirectionContacts = $this->directionsService->getAllOffices();
        $allDirections = $this->directionsService->getAllDirectionsExceptOne($this->direction);
        $this->allDirections = $this->directionsService->buildTree($allDirections);
        $this->directionParent = $this->direction->parent_id;

        // Set current direction contacts
        $this->directionContacts = $this->directionsService->setCurrentdirectionContacts($this->direction);

        // Set Section One data
        $this->directionTextBlockOne = DirectionTextBlock::where('number', 1)->where('direction_id', $this->direction->id)->first();
        $this->sectionOneData = $this->directionsService->setTextBlockData($this->directionTextBlockOne);

        // Set Section Two data
        $this->directionTextBlockTwo = DirectionTextBlock::where('number', 2)->where('direction_id', $this->direction->id)->first();
        $this->sectionTwoData = $this->directionsService->setTextBlockData($this->directionTextBlockTwo);
        
        // Set Prices
        $directionPrices = DirectionPrice::where('direction_id', $this->direction->id)->orderBy('sort', 'asc')->get();
        updateSort($directionPrices);
        $this->directionPrices = $this->directionsService->setPrices($directionPrices);
        $this->directionPrices = makeUsort($this->directionPrices);

        // Set Info data
        $infoData = DirectionInfoBlock::where('direction_id', $this->direction->id)->get();
        $this->infoData = $this->directionsService->setInfoData($infoData);

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
        }
    }

    public function addElementDirectionPrices()
    {
        $this->directionPrices[] = [
            'id' => null,
            'sort' => count($this->directionPrices) + 1,
            'price' => 0,
            'service' => []
        ];
    }

    public function removeElementDirectionPrices($index)
    {
        foreach($this->directionPrices as $index2 => $directionPrice) {
            if($directionPrice['sort'] > $this->directionPrices[$index]['sort']) {
                $this->directionPrices[$index2]['sort'] = $directionPrice['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->directionPrices)) {
            unset($this->directionPrices[$index]);
        }
    }

    public function removeElementDirectionInfo($index)
    {
        if (array_key_exists($index, $this->infoData)) {
            unset($this->infoData[$index]);
        }
    }

    public function addElementDirectionInfo()
    {
        $this->infoData[] = [
            'id' => null,
            'title' => [],
            'description' => [],
        ];
    }

    public function newPositionDirectionPrices($val, $index)
    {
        $this->directionPrices[$index + $val]['sort'] = $this->directionPrices[$index]['sort'];

        $this->directionPrices[$index]['sort'] = $this->directionPrices[$index]['sort'] + $val;

        $this->directionPrices = makeUsort($this->directionPrices);
    }

    protected function rules()
    {
        $rules = [];

        $rules['сurrentDirectionData.slug'] = [
            'required',
            'string',
            'unique:page_directions,slug,' . ($this->direction->page->id ?? ''),
            'unique:pages,slug'
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

        $this->direction->update([
            'parent_id' => $this->directionParent,
        ]);

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

        // Update Direction Prices
        $existingDirectionPrices = DirectionPrice::where('direction_id', $this->direction->id)->get();
        $this->directionsService->syncPrices($this->directionPrices, $existingDirectionPrices, $this->direction->id);
        
        // Update Direction Info
        $existingDirectionInfo = DirectionInfoBlock::where('direction_id', $this->direction->id)->get();
        $this->directionsService->syncInfo($this->infoData, $existingDirectionInfo, $this->direction->id);

        $this->direction->contacts()->sync($this->directionContacts);

        // Update Direction Page
        $directionData = [
            'name' => $this->сurrentDirectionData['name'],
            'slug' => $this->сurrentDirectionData['slug'],
            'parent_id' => $this->directionParent
        ];
        $this->directionsService->updateDirection($this->direction, $directionData);

        // Update Direction Page
        $this->directionsService->updatePage($this->direction->page, $this->seoData, $directionData);

        redirect()->route('directions.edit', ['directionId' => $this->direction->id])->with('success', trans('admin.data_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.templates.sub-category', ['direction' => $this->direction]);
    }

}