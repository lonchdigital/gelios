<?php

namespace App\Services\Admin\Contacts;

use App\Models\Page;
use App\Models\Test;
use App\Models\Price;
use App\Models\Contact;
use App\Models\ContactItem;
use Illuminate\Database\Eloquent\Collection;


class ContactsService 
{
    const IMAGE_PATH = '/contacts';

    public function setContactData(null|Contact $contact)
    {
        $data = [];

        $data['city'] = [];
        $data['street'] = [];
        $data['iframe'] = '';
        // $data['image'] = '';

        if(!is_null($contact)) {
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['city'][$lang] = $value['city'];
            }
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['street'][$lang] = $value['street'];
            }
            $data['media']['image'] = $contact->image;
            $data['iframe'] = $contact->iframe;
        }

        return $data;
    }
    

    public function syncItems(array $items, Collection $existingItems, int $contactID, string $type)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];

                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['item'] = $oneItem['item'];
                
                $existingItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [];

                $dataToUpdate['contact_id'] = $contactID;
                $dataToUpdate['type'] = $type;
                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['item'] = $oneItem['item'];
    
                ContactItem::create($dataToUpdate);
            }
        }

        // remove items
        $existingItemsInRequest = $items ? array_filter(array_column($items, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $itemsToDelete = $existingItems->whereNotIn('id', $existingItemsInRequest);

        foreach ($itemsToDelete as $itemToDelete) {
            removeImageFromStorage($itemToDelete->image);
            $itemToDelete->delete();
        }
    }

    
    public function updateContact(array $sectionData, null|Contact $contact)
    {
        $formData = [
            'image' => $sectionData['media'] ?? null,
            'city' => $sectionData['city'],
            'street' => $sectionData['street'],
            'iframe' => $sectionData['iframe'],
        ];

        $dataToUpdate = [];
        $dataToUpdate['iframe'] = $formData['iframe'];

        if(!is_null($formData['city'])) {
            foreach ($formData['city'] as $lang => $value) {
                $dataToUpdate[$lang]['city'] = $value;
            }
        }
        if(!is_null($formData['street'])) {
            foreach ($formData['street'] as $lang => $value) {
                $dataToUpdate[$lang]['street'] = $value;
            }
        }

        if(isset($formData['image']) && isset($formData['image']['newImage'])) {
            if(isset($formData['image']['image'])) {
                removeImageFromStorage($formData['image']['image']);
            }
            $image = downloadImage(self::IMAGE_PATH, $formData['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        if(!is_null($contact)) {
            $contact->update($dataToUpdate);
            return $contact;
        } else {
            return Contact::create($dataToUpdate);
        }
    }

    public function removeTest(int $testlID) 
    {
        $test = Test::find($testlID);
        
        $test->delete();
    }

}