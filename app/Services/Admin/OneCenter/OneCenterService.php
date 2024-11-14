<?php

namespace App\Services\Admin\OneCenter;

use App\Models\Page;
use App\Models\BriefBlock;
use Illuminate\Database\Eloquent\Collection;


class OneCenterService 
{
    const MEDIA_FOLDER = '/one-center';

    public function syncSlides(array $items, Collection $existingItems, int $pageID)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
                
                if(isset($oneItem['newImage'])) {
                    $image = null;
                    removeImageFromStorage($oneItem['oldImage']);
                    $image = downloadImage(self::MEDIA_FOLDER, $oneItem['newImage']);
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
                    $image = downloadImage(self::MEDIA_FOLDER, $oneItem['newImage']);
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
                    $image = downloadImage(self::MEDIA_FOLDER, $oneItem['newImage']);
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
                    $image = downloadImage(self::MEDIA_FOLDER, $oneItem['newImage']);
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

    

    public function setPageData(Page|null $page)
    {
        $data = [];

        if( !is_null($page) ) {

            if( !empty($page->getTranslationsArray()) ) {
                foreach ($page->getTranslationsArray() as $lang => $value) {
                    $data['title'][$lang] = $value['title'];
                }
            } else {
                $data['title'] = [];
            }

            $data['slug'] = $page->slug;
            $data['media']['video_file'] = $page->video_file;

        } else {
            $data['slug'] = '';
            $data['title'] = [];
            $data['media']['video_file'] = null;
        }

        return $data;
    }

    public function createPage(array $data): Page
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $dataToUpdate['type'] = 'one_center';
        $dataToUpdate['slug'] = $data['slug'];

        if(isset($data['media']['new_video_file'])) {
            $image = downloadVideoFile(self::MEDIA_FOLDER, $data['media']['new_video_file']);
            $dataToUpdate['video_file'] = $image;
        }

        $page = Page::create($dataToUpdate);
        return $page;
    }

    public function updatePageData(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $dataToUpdate['slug'] = $data['slug'];

        if(isset($data['media']['new_video_file'])) {
            $image = downloadVideoFile(self::MEDIA_FOLDER, $data['media']['new_video_file']);
            $dataToUpdate['video_file'] = $image;

            removeVideoFileFromStorage($page->video_file);
        }

        $page->update($dataToUpdate);
    }

    public function removeOneCenter(int $id)
    {
        $page = Page::find($id);

        foreach($page->briefBlocks as $briefBlock) {
            if(!is_null($briefBlock->image)){
                removeImageFromStorage($briefBlock->image);
            }
            
            $briefBlock->delete();
        }

        foreach($page->pageTextBlocks as $pageTextBlock) {
            if(!is_null($pageTextBlock->image)){
                removeImageFromStorage($pageTextBlock->image);
            }
            
            $pageTextBlock->delete();
        }

        removeVideoFileFromStorage($page->video_file);

        $page->delete();
    }

}