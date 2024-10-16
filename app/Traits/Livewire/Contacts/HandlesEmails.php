<?php

namespace App\Traits\Livewire\Contacts;

trait HandlesEmails
{
    public function newPositionEmails($val, $index)
    {
        $this->emails[$index + $val]['sort'] = $this->emails[$index]['sort'];
        $this->emails[$index]['sort'] = $this->emails[$index]['sort'] + $val;
        $this->emails = makeUsort($this->emails);
    }

    public function removeElementEmails($index)
    {
        foreach($this->emails as $index2 => $emailItem) {
            if($emailItem['sort'] > $this->emails[$index]['sort']) {
                $this->emails[$index2]['sort'] = $emailItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->emails)) {
            unset($this->emails[$index]);
        }
    }

    public function addElementEmails()
    {
        $this->emails[] = [
            'id' => null,
            'type' => 'email',
            'item' => null,
            'sort' => count($this->emails) + 1,
        ];
    }
}