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
    public DirectionTextBlock|null $directionTextBlockOne = null;
    public DirectionTextBlock|null $directionTextBlockTwo = null;
    public DirectionTextBlock|null $directionTextBlockThree = null;

    public array $sectionOneData = [];
    public array $sectionTwoData = [];
    public array $sectionThreeData = [];

    public array $seoData = [];

    protected DirectionsService $directionsService;
    
    public function mount() 
    {
        // Set Section One data
        $this->directionTextBlockOne = DirectionTextBlock::where('number', 1)->where('direction_id', $this->direction->id)->first();
        if(!is_null($this->directionTextBlockOne)) {
            foreach ($this->directionTextBlockOne->getTranslationsArray() as $lang => $value) {
                $this->sectionOneData['text_one'][$lang] = $value['text_one'];
            }
            foreach ($this->directionTextBlockOne->getTranslationsArray() as $lang => $value) {
                $this->sectionOneData['text_two'][$lang] = $value['text_two'];
            }
            $this->sectionOneData['media']['image'] = $this->directionTextBlockOne->image;
            $this->sectionOneData['is_reverse'] = $this->directionTextBlockOne->is_reverse;
            $this->sectionOneData['is_image'] = $this->directionTextBlockOne->is_image;
        } else {
            $this->sectionOneData['text_one'] = [];
            $this->sectionOneData['text_two'] = [];
            $this->sectionOneData['is_reverse'] = false;
            $this->sectionOneData['is_image'] = true;
        }

        // Set Section Two data
        $this->directionTextBlockTwo = DirectionTextBlock::where('number', 2)->where('direction_id', $this->direction->id)->first();
        if(!is_null($this->directionTextBlockTwo)) {
            foreach ($this->directionTextBlockTwo->getTranslationsArray() as $lang => $value) {
                $this->sectionTwoData['text_one'][$lang] = $value['text_one'];
            }
            foreach ($this->directionTextBlockTwo->getTranslationsArray() as $lang => $value) {
                $this->sectionTwoData['text_two'][$lang] = $value['text_two'];
            }
            $this->sectionTwoData['media']['image'] = $this->directionTextBlockTwo->image;
            $this->sectionTwoData['is_reverse'] = $this->directionTextBlockTwo->is_reverse;
            $this->sectionTwoData['is_image'] = $this->directionTextBlockTwo->is_image;
        } else {
            $this->sectionTwoData['text_one'] = [];
            $this->sectionTwoData['text_two'] = [];
            $this->sectionTwoData['is_reverse'] = false;
            $this->sectionTwoData['is_image'] = true;
        }
        
        // Set Section Three data
        $this->directionTextBlockThree = DirectionTextBlock::where('number', 3)->where('direction_id', $this->direction->id)->first();
        if(!is_null($this->directionTextBlockThree)) {
            foreach ($this->directionTextBlockThree->getTranslationsArray() as $lang => $value) {
                $this->sectionThreeData['text_one'][$lang] = $value['text_one'];
            }
            foreach ($this->directionTextBlockThree->getTranslationsArray() as $lang => $value) {
                $this->sectionThreeData['text_two'][$lang] = $value['text_two'];
            }
            $this->sectionThreeData['media']['image'] = $this->directionTextBlockThree->image;
            $this->sectionThreeData['is_reverse'] = $this->directionTextBlockThree->is_reverse;
            $this->sectionThreeData['is_image'] = $this->directionTextBlockThree->is_image;
        } else {
            $this->sectionThreeData['text_one'] = [];
            $this->sectionThreeData['text_two'] = [];
            $this->sectionThreeData['is_reverse'] = false;
            $this->sectionThreeData['is_image'] = true;
        }

        // Set SEO data
        if(!is_null($this->direction->page->meta_title)) {
            foreach ($this->direction->page->getTranslationsArray() as $lang => $value) {
                $this->seoData['meta_title'][$lang] = $value['meta_title'];
            }
        } else {
            $this->seoData['meta_title'] = [];
        }
        if(!is_null($this->direction->page->meta_description)) {
            foreach ($this->direction->page->getTranslationsArray() as $lang => $value) {
                $this->seoData['meta_description'][$lang] = $value['meta_description'];
            }
        } else {
            $this->seoData['meta_description'] = [];
        }
        if(!is_null($this->direction->page->meta_keywords)) {
            foreach ($this->direction->page->getTranslationsArray() as $lang => $value) {
                $this->seoData['meta_keywords'][$lang] = $value['meta_keywords'];
            }
        } else {
            $this->seoData['meta_keywords'] = [];
        }
        if(!is_null($this->direction->page->seo_text)) {
            foreach ($this->direction->page->getTranslationsArray() as $lang => $value) {
                $this->seoData['seo_text'][$lang] = $value['seo_text'];
            }
        } else {
            $this->seoData['seo_text'] = [];
        }
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
        return [
            'directionName.ua' => [
                'required',
                'string'
                // 'nullable'
            ],

        ];
    }

    public function save()
    {
        // $this->validate();

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

        // Update Direction Page
        $this->directionsService->updatePage($this->direction->page, $this->seoData);

        redirect()->route('directions.edit', ['directionId' => $this->direction->id])->with('success', trans('admin.data_updated'));
    }

    public function render()
    {
        return view('livewire.admin.directions.templates.category', ['direction' => $this->direction]);
    }

}