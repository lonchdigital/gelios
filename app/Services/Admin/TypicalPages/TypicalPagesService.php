<?php

namespace App\Services\Admin\TypicalPages;

use App\Models\Page;
use App\Models\BriefBlock;
use App\Models\PageTextBlock;
use Illuminate\Support\Collection;


class TypicalPagesService 
{
    const IMAGE_PATH = '/typical-pages';

    public function updateContentData(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['text']) {
            foreach ($data['text'] as $lang => $value) {
                $dataToUpdate[$lang]['text'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    public function setContentData(Page $page)
    {
        $data = [];

        foreach ($page->getTranslationsArray() as $lang => $value) {
            $data['title'][$lang] = $value['title'];
        }

        $data['slug'] = $page->slug;
        
        return $data;
    }

    public function createTypicalPage(array $data): Page
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $dataToUpdate['type'] = 'typical';
        $dataToUpdate['slug'] = $data['slug'];

        $page = Page::create($dataToUpdate);
        return $page;
    }

    public function updateTypicalPage(array $data, Page $page)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $dataToUpdate['slug'] = $data['slug'];

        $page->update($dataToUpdate);
    }

    public function syncBriefBlocks(array $items, Collection $existingItems, int $pageID)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];
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

                $dataToUpdate['page_id'] = $pageID;
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
    
                BriefBlock::create($dataToUpdate);
            }
        }

        // remove items
        $existingItemsInRequest = $items ? array_filter(array_column($items, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $itemsToDelete = $existingItems->whereNotIn('id', $existingItemsInRequest);

        foreach ($itemsToDelete as $itemToDelete) {
            $itemToDelete->delete();
        }
    }

    public function setTextBlockData(null|PageTextBlock $pageTextBlock) : array
    {
        $data = [];

        $data['text_one'] = [];
        $data['text_two'] = [];
        $data['is_reverse'] = false;
        $data['is_image'] = true;

        if(!is_null($pageTextBlock)) {
            foreach ($pageTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_one'][$lang] = $value['text_one'];
            }
            foreach ($pageTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_two'][$lang] = $value['text_two'];
            }
            $data['media']['image'] = $pageTextBlock->image;
            $data['is_reverse'] = $pageTextBlock->is_reverse;
            $data['is_image'] = $pageTextBlock->is_image;
        }

        return $data;
    }

    public function updateTextBlock(array $data, null|PageTextBlock $pageTextBlock, null|Page $page)
    {
        $dataToUpdate = [];
        $dataToUpdate['is_reverse'] = $data['is_reverse'];
        $dataToUpdate['is_image'] = $data['is_image'];

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
            $image = downloadImage(self::IMAGE_PATH, $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        if(!is_null($pageTextBlock)) {
            $pageTextBlock->update($dataToUpdate);
        } else {
            $dataToUpdate['page_id'] = $page->id;
            PageTextBlock::create($dataToUpdate);
        }
    }

    public function removePageTextBlock(int $id)
    {
        $pageTextBlock = PageTextBlock::find($id);

        if(!is_null($pageTextBlock->image)){
            removeImageFromStorage($pageTextBlock->image);
        }
        
        $pageTextBlock->delete();
    }

    public function removeTypicalPage(int $id)
    {
        $page = Page::find($id);

        foreach($page->pageTextBlocks as $pageTextBlock) {
            if(!is_null($pageTextBlock->image)){
                removeImageFromStorage($pageTextBlock->image);
            }
            
            $pageTextBlock->delete();
        }

        $page->delete();
    }
}