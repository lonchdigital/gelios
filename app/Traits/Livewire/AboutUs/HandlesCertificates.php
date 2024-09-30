<?php

namespace App\Traits\Livewire\AboutUs;

trait HandlesCertificates
{
    public function newPositionCertificates($val, $index)
    {
        $this->сertificates[$index + $val]['sort'] = $this->сertificates[$index]['sort'];
        $this->сertificates[$index]['sort'] = $this->сertificates[$index]['sort'] + $val;
        $this->сertificates = makeUsort($this->сertificates);
    }

    protected function handleImageChangeForCertificates($propertyName)
    {
        preg_match('/сertificates\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];
        $this->сertificates[$index]['temporaryImage'] = $this->сertificates[$index]['newImage']->temporaryUrl();
    }

    public function deleteImageCertificates($index)
    {
        $this->сertificates[$index]['image'] = null;
        $this->сertificates[$index]['temporaryImage'] = null;
    }

    public function removeElementCertificates($index)
    {
        foreach($this->сertificates as $index2 => $сertificate) {
            if($сertificate['sort'] > $this->сertificates[$index]['sort']) {
                $this->сertificates[$index2]['sort'] = $сertificate['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->сertificates)) {
            unset($this->сertificates[$index]);
        }
    }

    public function addElementCertificates()
    {
        $this->сertificates[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->сertificates) + 1,
        ];
    }
}