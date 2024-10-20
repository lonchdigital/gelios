<?php

namespace App\Traits\Livewire\TypicalPages;

trait HandlesBriefBlocks
{
    public function newPositionBriefBlocks($val, $index)
    {
        $this->briefBlocks[$index + $val]['sort'] = $this->briefBlocks[$index]['sort'];
        $this->briefBlocks[$index]['sort'] = $this->briefBlocks[$index]['sort'] + $val;
        $this->briefBlocks = makeUsort($this->briefBlocks);
    }

    public function removeElementBriefBlocks($index)
    {
        foreach($this->briefBlocks as $index2 => $briefBlock) {
            if($briefBlock['sort'] > $this->briefBlocks[$index]['sort']) {
                $this->briefBlocks[$index2]['sort'] = $briefBlock['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->briefBlocks)) {
            unset($this->briefBlocks[$index]);
        }
    }

    public function addElementBriefBlocks()
    {
        $this->briefBlocks[] = [
            'id' => null,
            'title' => [],
            'description' => [],
            'sort' => count($this->briefBlocks) + 1,
        ];
    }
}