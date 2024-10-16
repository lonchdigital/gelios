<?php

namespace App\Traits\Livewire\Contacts;

trait HandlesPhones
{
    public function newPositionPhones($val, $index)
    {
        $this->phones[$index + $val]['sort'] = $this->phones[$index]['sort'];
        $this->phones[$index]['sort'] = $this->phones[$index]['sort'] + $val;
        $this->phones = makeUsort($this->phones);
    }

    public function removeElementPhones($index)
    {
        foreach($this->phones as $index2 => $phonItem) {
            if($phonItem['sort'] > $this->phones[$index]['sort']) {
                $this->phones[$index2]['sort'] = $phonItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->phones)) {
            unset($this->phones[$index]);
        }
    }

    public function addElementPhones()
    {
        $this->phones[] = [
            'id' => null,
            'type' => 'phone',
            'item' => null,
            'sort' => count($this->phones) + 1,
        ];
    }
}