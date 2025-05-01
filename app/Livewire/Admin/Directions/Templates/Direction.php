<?php

namespace App\Livewire\Admin\Directions\Templates;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DirectionPrice;
use App\Models\InsuranceCompany;
use App\Models\DirectionInfoBlock;
use App\Models\DirectionTextBlock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;


class Direction extends Component
{
    use WithFileUploads;

    public $direction;

    public array $сurrentDirectionData = [];

    public DirectionTextBlock|null $directionTextBlockOne = null;
    public DirectionTextBlock|null $directionTextBlockTwo = null;
    public DirectionTextBlock|null $directionTextBlockThree = null;
    public DirectionTextBlock|null $directionTextBlockFour = null;
    public DirectionTextBlock|null $directionTextBlockFive = null;

    public array $sectionOneData = [];
    public array $sectionTwoData = [];
    public array $sectionThreeData = [];
    public array $sectionFourData = [];
    public array $sectionFiveData = [];

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
        
        // Set Section Three data
        $this->directionTextBlockThree = DirectionTextBlock::where('number', 3)->where('direction_id', $this->direction->id)->first();
        $this->sectionThreeData = $this->directionsService->setTextBlockData($this->directionTextBlockThree);
        
        // Set Section Four data
        $this->directionTextBlockFour = DirectionTextBlock::where('number', 4)->where('direction_id', $this->direction->id)->first();
        $this->sectionFourData = $this->directionsService->setTextBlockData($this->directionTextBlockFour);
        
        // Set Section Five data
        $this->directionTextBlockFive = DirectionTextBlock::where('number', 5)->where('direction_id', $this->direction->id)->first();
        $this->sectionFiveData = $this->directionsService->setTextBlockData($this->directionTextBlockFive);

        // Set Prices
        $directionPrices = DirectionPrice::where('direction_id', $this->direction->id)->orderBy('sort', 'asc')->get();
        // updateSort($directionPrices);
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
        if (preg_match('/sectionThreeData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(3);
        }
        if (preg_match('/sectionFourData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(4);
        }
        if (preg_match('/sectionFiveData.media.newImage/', $propertyName)) {
            $this->handleSectionImage(5);
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
            case 4:
                $this->sectionFourData['media']['temporaryImage'] = $this->sectionFourData['media']['newImage']->temporaryUrl();
                break;
            case 5:
                $this->sectionFiveData['media']['temporaryImage'] = $this->sectionFiveData['media']['newImage']->temporaryUrl();
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
            case 4:
                $this->sectionFourData['is_image'] = $this->sectionFourData['is_image'];
                break;
            case 5:
                $this->sectionFiveData['is_image'] = $this->sectionFiveData['is_image'];
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
            case 4:
                $this->sectionFourData['media']['image'] = null;
                $this->sectionFourData['media']['temporaryImage'] = null;
                break;
            case 5:
                $this->sectionFiveData['media']['image'] = null;
                $this->sectionFiveData['media']['temporaryImage'] = null;
                break;
        }
    }

    public function addElementDirectionPrices()
    {
        $this->directionPrices[] = [
            'id' => null,
            'sort' => count($this->directionPrices) + 1,
            'price' => [],
            'service' => [],
            'is_free' => 0,
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

        $this->dispatch('infoDataFieldAdded');
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
        $rules['сurrentDirectionData.in_footer'] = [
            'boolean'
        ];

        $rules['directionContacts'] = [
            'array'
        ];
        $rules['directionPrices'] = [
            'array'
        ];
        $rules['infoData'] = [
            'array'
        ];

        $rules['sectionOneData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionOneData.is_image'] = [
            'boolean'
        ];
        $rules['sectionThreeData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionThreeData.is_image'] = [
            'boolean'
        ];
        $rules['sectionFourData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionFourData.is_image'] = [
            'boolean'
        ];
        $rules['sectionFiveData.is_reverse'] = [
            'boolean'
        ];
        $rules['sectionFiveData.is_image'] = [
            'boolean'
        ];

        foreach (config('translatable.locales') as $locale):
            $rules['сurrentDirectionData.name.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['сurrentDirectionData.short_name.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];

            $rules['sectionOneData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionOneData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionTwoData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionTwoData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionThreeData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionThreeData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionFourData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionFourData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionFiveData.text_one.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['sectionFiveData.text_two.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            

            // seo
            $rules['seoData.meta_title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['seoData.meta_description.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['seoData.meta_keywords.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
            $rules['seoData.seo_title.' . $locale] = [
                'nullable',
                'string',
                'max:255'
            ];
            $rules['seoData.seo_text.' . $locale] = [
                'nullable',
                'string',
                'max:55000'
            ];
        endforeach;

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
            'button_one_url' => $this->sectionThreeData['button_one_url'],
        ];
        $this->directionsService->updateTextBlock($formDataThree);

        $formDataFour = [
            'direction_id' => $this->direction->id,
            'number' => 4,
            'image' => $this->sectionFourData['media'] ?? null,
            'text_one' => $this->sectionFourData['text_one'],
            'text_two' => $this->sectionFourData['text_two'],
            'is_reverse' => $this->sectionFourData['is_reverse'],
            'is_image' => $this->sectionFourData['is_image'],
        ];
        $this->directionsService->updateTextBlock($formDataFour);

        $formDataFive = [
            'direction_id' => $this->direction->id,
            'number' => 5,
            'image' => $this->sectionFiveData['media'] ?? null,
            'text_one' => $this->sectionFiveData['text_one'],
            'text_two' => $this->sectionFiveData['text_two'],
            'is_reverse' => $this->sectionFiveData['is_reverse'],
            'is_image' => $this->sectionFiveData['is_image'],
        ];
        $this->directionsService->updateTextBlock($formDataFive);


        // Update Direction Prices
        $existingDirectionPrices = DirectionPrice::where('direction_id', $this->direction->id)->get();
        $this->directionsService->syncPrices($this->directionPrices, $existingDirectionPrices, $this->direction->id);

        // Update Direction Info
        $existingDirectionInfo = DirectionInfoBlock::where('direction_id', $this->direction->id)->get();
        $this->directionsService->syncInfo($this->infoData, $existingDirectionInfo, $this->direction->id);

        $this->direction->contacts()->sync($this->directionContacts);

        // Update Direction
        $directionData = [
            'name' => $this->сurrentDirectionData['name'],
            'short_name' => $this->сurrentDirectionData['short_name'],
            'in_footer' => $this->сurrentDirectionData['in_footer'],
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
        return view('livewire.admin.directions.templates.direction', ['direction' => $this->direction]);
    }

}