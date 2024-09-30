<?php

namespace App\Services\Admin\AboutUs;

use App\Models\Page;
use App\Models\BriefBlock;
use Illuminate\Support\Str;
use App\Models\SectionImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class AboutUsService 
{

    public function syncBriefBlocks(array $items, Collection $existingItems, int $pageID)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
                
                if(isset($oneItem['newImage'])) {
                    $image = null;
                    removeImageFromStorage($oneItem['oldImage']);
                    $image = downloadImage('/about-us', $oneItem['newImage']);
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
                    $image = downloadImage('/about-us', $oneItem['newImage']);
                }

                $dataToUpdate['page_id'] = $pageID;
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


    public function syncSectionImages(array $items, Collection $existingItems, int $pageID, $type)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
                
                if(isset($oneItem['newImage'])) {
                    $image = null;
                    removeImageFromStorage($oneItem['oldImage']);
                    $image = downloadImage('/about-us', $oneItem['newImage']);
                    $dataToUpdate['image'] = $image;
                }

                $dataToUpdate['sort'] = $oneItem['sort'];
                
                $existingItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [];
                $image = null;
                if(isset($oneItem['newImage'])) {
                    $image = downloadImage('/about-us', $oneItem['newImage']);
                }

                $dataToUpdate['page_id'] = $pageID;
                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['type'] = $type;
                $dataToUpdate['image'] = $image;
    
                SectionImage::create($dataToUpdate);
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

    

}