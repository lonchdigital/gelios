<?php

namespace App\Services\Admin\Contacts;

use App\Models\Page;
use App\Models\Test;
use App\Models\Price;
use App\Models\Contact;
use App\Models\ContactGallery;
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
        $data['title'] = [];
        $data['text'] = [];
        $data['iframe'] = '';
        $data['map_url'] = '';
        // $data['image'] = '';

        if(!is_null($contact)) {
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['city'][$lang] = $value['city'];
            }
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['street'][$lang] = $value['street'];
            }
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
            foreach ($contact->getTranslationsArray() as $lang => $value) {
                $data['text'][$lang] = $value['text'];
            }
            $data['media']['image'] = $contact->image;
            $data['iframe'] = $contact->iframe;
            $data['map_url'] = $contact->map_url;
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
            'title' => $sectionData['title'],
            'text' => $sectionData['text'],
            'iframe' => $sectionData['iframe'],
            'map_url' => $sectionData['map_url'],
        ];

        $dataToUpdate = [];
        $dataToUpdate['iframe'] = $formData['iframe'];
        $dataToUpdate['map_url'] = $formData['map_url'];

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
        if(!is_null($formData['title'])) {
            foreach ($formData['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }
        if(!is_null($formData['text'])) {
            foreach ($formData['text'] as $lang => $value) {
                $dataToUpdate[$lang]['text'] = $value;
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

    public function removeContact(int $contactID)
    {
        $contact = Contact::find($contactID);

        $contact->directions()->sync([]);

        // remove gallery
        $galleryToDelete = ContactGallery::where('contact_id', $contactID)->get();
        foreach ($galleryToDelete as $galleryImage) {
            removeImageFromStorage($galleryImage->image);
            $galleryImage->delete();
        }

        if(!is_null($contact->image)){
            removeImageFromStorage($contact->image);
        }
        
        $contact->delete();
    }


    public function syncGallery(array $gallery, Collection $existingGallery, int $contactID)
    {
        foreach( $gallery as $galleryItem ) {
            $existingGalleryItem = $existingGallery->where('id', $galleryItem['id'])->first();

            if( !is_null($existingGalleryItem) ) {
                $dataToUpdate = [
                    'sort' => $galleryItem['sort']
                ];
                
                $existingGalleryItem->update($dataToUpdate);
            } else {
                $image = null;
                if(isset($galleryItem['newImage'])) {
                    $image = downloadImage(self::IMAGE_PATH, $galleryItem['newImage']);
                }
    
                ContactGallery::create([
                    'contact_id' => $contactID,
                    'sort' => $galleryItem['sort'],
                    'image' => $image,
                ]);
            }
        }

        // remove items
        $existingGalleryInRequest = $gallery ? array_filter(array_column($gallery, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $galleriesToDelete = $existingGallery->whereNotIn('id', $existingGalleryInRequest);

        foreach ($galleriesToDelete as $galleryToDelete) {
            removeImageFromStorage($galleryToDelete->image);
            $galleryToDelete->delete();
        }
    }


    public function setPageData(Page $page)
    {
        $data = [];

        if( !empty($page->getTranslationsArray()) ) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
        } else {
            $data['title'] = [];
        }

        return $data;
    }

    public function updatePageData(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }
}