<?php

namespace App\Livewire\Admin\Offices;

use App\Models\Contact;
use App\Models\ContactGallery;
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
    public array $gallery = [];

    protected ContactsService $contactsService;
    
    public function mount() 
    {
        $this->contactsService = app(ContactsService::class);
        $this->dispatch('livewire:load');

        $this->sectionData = $this->contactsService->setContactData($this->contact);


        if(!is_null($this->contact)) {
            // Set phones
            $phones = ContactItem::where('contact_id', $this->contact->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
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
            foreach($emails as $email) {
                $this->emails[] = [
                    'id' => $email->id,
                    'sort' => $email->sort,
                    'type' => $email->type,
                    'item' => $email->item
                ];
            }
            $this->emails = makeUsort($this->emails);

            // set gallery
            $gallery = ContactGallery::where('contact_id', $this->contact->id)->orderBy('sort', 'asc')->get();
            foreach($gallery as $galleryItem) {
                $this->gallery[] = [
                    'id' => $galleryItem->id,
                    'sort' => $galleryItem->sort,
                    'oldImage' => $galleryItem->image ?? '',
                    'newImage' => null,
                    'image' => $galleryItem->image
                ];
            }
            $this->gallery = makeUsort($this->gallery);
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
        if (preg_match('/gallery\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForGallery($propertyName);
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


    public function newPositionGallery($val, $index)
    {
        $this->gallery[$index + $val]['sort'] = $this->gallery[$index]['sort'];

        $this->gallery[$index]['sort'] = $this->gallery[$index]['sort'] + $val;

        $this->gallery = makeUsort($this->gallery);
    }
    protected function handleImageChangeForGallery($propertyName)
    {
        preg_match('/gallery\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->gallery[$index]['temporaryImage'] = $this->gallery[$index]['newImage']->temporaryUrl();
    }
    public function deleteImageGallery($index)
    {
        $this->gallery[$index]['image'] = null;
        $this->gallery[$index]['temporaryImage'] = null;
    }
    public function removeElementGallery($index)
    {
        foreach($this->gallery as $index2 => $galleryItem) {
            if($galleryItem['sort'] > $this->gallery[$index]['sort']) {
                $this->gallery[$index2]['sort'] = $galleryItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->gallery)) {
            unset($this->gallery[$index]);
        }
    }
    public function addElementGallery()
    {
        $this->gallery[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->gallery) + 1,
        ];
    }


    protected function rules(): array
    {
        $rules = [
            'sectionData.iframe' => [
                'required',
                'string',
            ],
            'sectionData.media.newImage' => [
                'nullable',
                'mimes:jpeg,jpg,png',
                'image',
            ],

            'phones.*.item' => [
                'required',
                'string',
            ],
            'emails.*.item' => [
                'required',
                'email',
            ],

            'gallery.*.newImage' => [
                'nullable',
                'mimes:jpeg,jpg,png',
                'image',
            ],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['sectionData.city.' . $locale] = [
                'required',
                'string',
                'max:255'
            ];
            $rules['sectionData.street.' . $locale] = [
                'required',
                'string',
                'max:255'
            ];
            $rules['sectionData.title.' . $locale] = [
                'required',
                'string',
                'max:255'
            ];
            $rules['sectionData.text.' . $locale] = [
                'required',
                'string',
            ];
        }

        return $rules;
    }

    protected function attributes()
    {
        $attributes = [];

        $attributes['sectionData.iframe'] = 'iframe';
        $attributes['phones.*.item'] = trans('admin.phone');
        $attributes['emails.*.item'] = trans('admin.email');

        foreach (config('translatable.locales') as $locale) {
            $attributes['sectionData.city.' . $locale] = trans('admin.city') . ' ('. $locale .')';
            $attributes['sectionData.street.' . $locale] = trans('admin.street') . ' ('. $locale .')';
            $attributes['sectionData.title.' . $locale] = trans('admin.title') . ' ('. $locale .')';
            $attributes['sectionData.text.' . $locale] = trans('admin.text') . ' ('. $locale .')';
        }

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    public function save()
    {
        $this->validate();
        
        $currentContact = $this->contactsService->updateContact($this->sectionData, $this->contact);
        
        // update phones
        $existingPhones = ContactItem::where('contact_id', $currentContact->id)->where('type', 'phone')->orderBy('sort', 'asc')->get();
        $this->contactsService->syncItems($this->phones, $existingPhones, $currentContact->id, 'phone');
        
        // update emails
        $existingEmails = ContactItem::where('contact_id', $currentContact->id)->where('type', 'email')->orderBy('sort', 'asc')->get();
        $this->contactsService->syncItems($this->emails, $existingEmails, $currentContact->id, 'email');

        // update gallery
        $existingGallery = ContactGallery::where('contact_id', $currentContact->id)->get();
        $this->contactsService->syncGallery($this->gallery, $existingGallery, $currentContact->id);

        redirect()->route('offices.edit', ['contact' => $currentContact])->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.offices.edit');
    }

}
