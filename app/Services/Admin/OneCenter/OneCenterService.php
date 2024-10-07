<?php

namespace App\Services\Admin\OneCenter;

use App\Models\Page;
use App\Models\Hospital;
use App\Models\BriefBlock;
use Illuminate\Support\Str;
use App\Models\PageDirection;
use App\Models\HospitalGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class OneCenterService 
{
    const IMAGES_FOLDER = '/one-center';

    public function syncSlides(array $items, Collection $existingItems, int $pageID)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
                
                if(isset($oneItem['newImage'])) {
                    $image = null;
                    removeImageFromStorage($oneItem['oldImage']);
                    $image = downloadImage(self::IMAGES_FOLDER, $oneItem['newImage']);
                    $dataToUpdate['image'] = $image;
                }

                $dataToUpdate['sort'] = $oneItem['sort'];

                if(!is_null($oneItem['title'])) {
                    foreach ($oneItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
                if(!is_null($oneItem['description'])) {
                    foreach ($oneItem['description'] as $lang => $value) {
                        $dataToUpdate[$lang]['description'] = $value;
                    }
                }
                
                $existingItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [];
                $image = null;
                if(isset($oneItem['newImage'])) {
                    $image = downloadImage(self::IMAGES_FOLDER, $oneItem['newImage']);
                }

                $dataToUpdate['page_id'] = $pageID;
                $dataToUpdate['type'] = 'slider';
                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['image'] = $image;

                if(!is_null($oneItem['title'])) {
                    foreach ($oneItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
                if(!is_null($oneItem['description'])) {
                    foreach ($oneItem['description'] as $lang => $value) {
                        $dataToUpdate[$lang]['description'] = $value;
                    }
                }
    
                BriefBlock::create($dataToUpdate);
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
    
    public function syncBriefBlocks(array $items, Collection $existingItems, int $pageID)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
                
                if(isset($oneItem['newImage'])) {
                    $image = null;
                    removeImageFromStorage($oneItem['oldImage']);
                    $image = downloadImage(self::IMAGES_FOLDER, $oneItem['newImage']);
                    $dataToUpdate['image'] = $image;
                }

                $dataToUpdate['sort'] = $oneItem['sort'];

                if(!is_null($oneItem['title'])) {
                    foreach ($oneItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
                
                $existingItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [];
                $image = null;
                if(isset($oneItem['newImage'])) {
                    $image = downloadImage(self::IMAGES_FOLDER, $oneItem['newImage']);
                }

                $dataToUpdate['page_id'] = $pageID;
                $dataToUpdate['type'] = 'briefBlocks';
                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['image'] = $image;

                if(!is_null($oneItem['title'])) {
                    foreach ($oneItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
    
                BriefBlock::create($dataToUpdate);
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