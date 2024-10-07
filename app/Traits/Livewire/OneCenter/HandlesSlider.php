<?php

namespace App\Traits\Livewire\OneCenter;

trait HandlesSlider
{
    public function newPositionSlides($val, $index)
    {
        $this->slides[$index + $val]['sort'] = $this->slides[$index]['sort'];
        $this->slides[$index]['sort'] = $this->slides[$index]['sort'] + $val;
        $this->slides = makeUsort($this->slides);
    }

    protected function handleImageChangeForSlides($propertyName)
    {
        preg_match('/slides\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];
        $this->slides[$index]['temporaryImage'] = $this->slides[$index]['newImage']->temporaryUrl();
    }

    public function deleteImageSlides($index)
    {
        $this->slides[$index]['image'] = null;
        $this->slides[$index]['temporaryImage'] = null;
    }

    public function removeElementSlides($index)
    {
        foreach($this->slides as $index2 => $slide) {
            if($slide['sort'] > $this->slides[$index]['sort']) {
                $this->slides[$index2]['sort'] = $slide['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->slides)) {
            unset($this->slides[$index]);
        }
    }

    public function addElementSlides()
    {
        $this->slides[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'title' => [],
            'description' => [],
            'sort' => count($this->slides) + 1,
        ];
    }
}