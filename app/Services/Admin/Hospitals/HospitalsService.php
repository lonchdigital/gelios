<?php

namespace App\Services\Admin\Hospitals;

use App\Models\Page;
use App\Models\Hospital;
use Illuminate\Support\Str;
use App\Models\PageDirection;
use App\Models\HospitalGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class HospitalsService 
{

    public function setTextBlockData(null|Hospital $hospital) : array
    {
        $data = [];

        $data['name'] = [];
        $data['text_one'] = [];
        $data['text_two'] = [];
        $data['is_reverse'] = false;
        $data['is_image'] = true;

        if(!is_null($hospital)) {
            foreach ($hospital->getTranslationsArray() as $lang => $value) {
                $data['name'][$lang] = $value['name'];
            }
            foreach ($hospital->getTranslationsArray() as $lang => $value) {
                $data['text_one'][$lang] = $value['text_one'];
            }
            foreach ($hospital->getTranslationsArray() as $lang => $value) {
                $data['text_two'][$lang] = $value['text_two'];
            }
            $data['media']['image'] = $hospital->image;
            $data['is_reverse'] = $hospital->is_reverse;
            $data['is_image'] = $hospital->is_image;
        }

        return $data;
    }

    public function updateTextBlock(array $data, null|Hospital $hospital)
    {
        $dataToUpdate = [];
        $dataToUpdate['is_reverse'] = $data['is_reverse'];
        $dataToUpdate['is_image'] = $data['is_image'];

        if(!is_null($data['name'])) {
            foreach ($data['name'] as $lang => $value) {
                $dataToUpdate[$lang]['name'] = $value;
            }
        }
        if(!is_null($data['text_one'])) {
            foreach ($data['text_one'] as $lang => $value) {
                $dataToUpdate[$lang]['text_one'] = $value;
            }
        }
        if(!is_null($data['text_two'])) {
            foreach ($data['text_two'] as $lang => $value) {
                $dataToUpdate[$lang]['text_two'] = $value;
            }
        }

        if(isset($data['image']) && isset($data['image']['newImage'])) {
            if(isset($data['image']['image'])) {
                removeImageFromStorage($data['image']['image']);
            }
            $image = downloadImage('/hospitals', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        if(!is_null($hospital)) {
            $hospital->update($dataToUpdate);
            return $hospital;
        } else {
            return Hospital::create($dataToUpdate);
        }
    }

    public function removeHospital(int $hospitalID) 
    {
        $hospital = Hospital::find($hospitalID);

        // remove gallery
        $galleryToDelete = HospitalGallery::where('hospital_id', $hospitalID)->get();
        foreach ($galleryToDelete as $galleryImage) {
            removeImageFromStorage($galleryImage->image);
            $galleryImage->delete();
        }

        // remove hospital
        if(!is_null($hospital->image)){
            removeImageFromStorage($hospital->image);
        }
        $hospital->delete();
    }

    public function syncGallery(array $gallery, Collection $existingGallery, int $hospitalID)
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
                    $image = downloadImage('/hospitals', $galleryItem['newImage']);
                }
    
                HospitalGallery::create([
                    'hospital_id' => $hospitalID,
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


    public function setSeoData(Page $page)
    {
        $data = [];

        if(!is_null($page->meta_title)) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['meta_title'][$lang] = $value['meta_title'];
            }
        } else {
            $data['meta_title'] = [];
        }
        if(!is_null($page->meta_description)) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['meta_description'][$lang] = $value['meta_description'];
            }
        } else {
            $data['meta_description'] = [];
        }
        if(!is_null($page->meta_keywords)) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['meta_keywords'][$lang] = $value['meta_keywords'];
            }
        } else {
            $data['meta_keywords'] = [];
        }
        if(!is_null($page->seo_text)) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['seo_text'][$lang] = $value['seo_text'];
            }
        } else {
            $data['seo_text'] = [];
        }

        return $data;
    }

    public function updatePage(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['meta_title']) {
            foreach ($data['meta_title'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_title'] = $value;
            }
        }
        if($data['meta_description']) {
            foreach ($data['meta_description'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_description'] = $value;
            }
        }
        if($data['meta_keywords']) {
            foreach ($data['meta_keywords'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_keywords'] = $value;
            }
        }
        if($data['seo_text']) {
            foreach ($data['seo_text'] as $lang => $value) {
                $dataToUpdate[$lang]['seo_text'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

}