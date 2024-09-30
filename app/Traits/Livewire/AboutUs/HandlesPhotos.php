<?php

namespace App\Traits\Livewire\AboutUs;

trait HandlesPhotos
{
    public function newPositionPhotos($val, $index)
    {
        $this->photos[$index + $val]['sort'] = $this->photos[$index]['sort'];
        $this->photos[$index]['sort'] = $this->photos[$index]['sort'] + $val;
        $this->photos = makeUsort($this->photos);
    }

    protected function handleImageChangeForPhotos($propertyName)
    {
        preg_match('/photos\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];
        $this->photos[$index]['temporaryImage'] = $this->photos[$index]['newImage']->temporaryUrl();
    }

    public function deleteImagePhotos($index)
    {
        $this->photos[$index]['image'] = null;
        $this->photos[$index]['temporaryImage'] = null;
    }

    public function removeElementPhotos($index)
    {
        foreach($this->photos as $index2 => $photo) {
            if($photo['sort'] > $this->photos[$index]['sort']) {
                $this->photos[$index2]['sort'] = $photo['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->photos)) {
            unset($this->photos[$index]);
        }
    }

    public function addElementPhotos()
    {
        $this->photos[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->photos) + 1,
        ];
    }
}