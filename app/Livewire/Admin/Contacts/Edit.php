<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;
use App\Models\ContactItem;
use Livewire\WithFileUploads;
use App\Traits\Livewire\Contacts\HandlesEmails;
use App\Traits\Livewire\Contacts\HandlesPhones;
use App\Services\Admin\Contacts\ContactsService;


class Edit extends Component
{
    use WithFileUploads, HandlesPhones, HandlesEmails;

    public Contact|null $contact = null;

    public array $sectionData = [];
    public array $phones = [];
    public array $emails = [];

    protected ContactsService $contactsService;
    
    public function mount() 
    {
        $this->contactsService = app(ContactsService::class);
        $this->dispatch('livewire:load');

        $this->sectionData = $this->contactsService->setContactData($this->contact);


        if(!is_null($this->contact)) {
            // Set phones
            $phones = ContactItem::where('contact_id', $this->contact->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
            updateSort($phones);
            foreach($phones as $phone) {
                $this->phones[] = [
                    'id' => $phone->id,
                    'sort' => $phone->sort,
                    'type' => $phone->type,
                    'item' => $phone->item
                ];
            }
            $this->phones = makeUsort($this->phones);

            // Set emails
            $emails = ContactItem::where('contact_id', $this->contact->id)->where('type', 'email')->orderBy('sort', 'asc')->get();
            updateSort($emails);
            foreach($emails as $email) {
                $this->emails[] = [
                    'id' => $email->id,
                    'sort' => $email->sort,
                    'type' => $email->type,
                    'item' => $email->item
                ];
            }
            $this->emails = makeUsort($this->emails);
        }
        
        
    }

    public function hydrate()
    {
        $this->contactsService = app(ContactsService::class);
    }


    public function updated($propertyName)
    {
        if (preg_match('/sectionData.media.newImage/', $propertyName)) {
            $this->handleContactImage();
        }
    }
    protected function handleContactImage()
    {
        $this->sectionData['media']['temporaryImage'] = $this->sectionData['media']['newImage']->temporaryUrl();
    }
    public function deleteContactImage()
    {
        $this->sectionData['media']['image'] = null;
        $this->sectionData['media']['temporaryImage'] = null;
    }


    public function newPositionPrices($val, $index)
    {
        $this->prices[$index + $val]['sort'] = $this->prices[$index]['sort'];

        $this->prices[$index]['sort'] = $this->prices[$index]['sort'] + $val;

        $this->prices = makeUsort($this->prices);
    }
    public function removeElementPrices($index)
    {
        foreach($this->prices as $index2 => $priceItem) {
            if($priceItem['sort'] > $this->prices[$index]['sort']) {
                $this->prices[$index2]['sort'] = $priceItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->prices)) {
            unset($this->prices[$index]);
        }
    }
    public function addElementPrices()
    {
        $this->prices[] = [
            'id' => null,
            'sort' => count($this->prices) + 1,
            'price' => 0,
            'service' => []
        ];
    }

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();
        
        $currentContact = $this->contactsService->updateContact($this->sectionData, $this->contact);
        
        // update phones
        $existingPhones = ContactItem::where('contact_id', $currentContact->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
        $this->contactsService->syncItems($this->phones, $existingPhones, $currentContact->id, 'phone');
        
        // update emails
        $existingEmails = ContactItem::where('contact_id', $currentContact->id)->where('type', 'email')->orderBy('sort', 'asc')->get();
        $this->contactsService->syncItems($this->emails, $existingEmails, $currentContact->id, 'email');

        redirect()->route('contacts.index')->with('success', trans('admin.added_contact'));
    }

    public function render()
    {
        return view('livewire.admin.contacts.edit');
    }

}
