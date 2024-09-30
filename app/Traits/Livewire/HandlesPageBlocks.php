<?php

namespace App\Traits\Livewire;

use App\Models\PageTextBlock;
use App\Models\PageMediaBlock;

trait HandlesPageBlocks
{

    public function setPageTextBlock(null|PageTextBlock $pageTextBlock) : array
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

    public function updatePageTextBlock(array $data, int $pageID, int $number)
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
            $image = downloadImage('/page-text-blocks', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        $pageTextBlock = PageTextBlock::where('page_id', $pageID)->where('number', $number)->first();

        if(!is_null($pageTextBlock)) {
            $pageTextBlock->update($dataToUpdate);
        } else {
            $dataToUpdate['number'] = $number;
            $dataToUpdate['page_id'] = $pageID;
            PageTextBlock::create($dataToUpdate);
        }
    }

    public function setPageMediaBlock(null|PageMediaBlock $pageMediaBlock) : array
    {
        $data = [];

        $data['text'] = [];
        $data['is_reverse'] = false;
        $data['is_image'] = true;
        $data['video'] = null;

        if(!is_null($pageMediaBlock)) {
            foreach ($pageMediaBlock->getTranslationsArray() as $lang => $value) {
                $data['text'][$lang] = $value['text'];
            }
            $data['media']['image'] = $pageMediaBlock->image;
            $data['is_reverse'] = $pageMediaBlock->is_reverse;
            $data['is_image'] = $pageMediaBlock->is_image;
            $data['video'] = $pageMediaBlock->video;
        }

        return $data;
    }

    public function updatePageMediaBlock(array $data, int $pageID, int $number)
    {
        $dataToUpdate = [];
        $dataToUpdate['is_reverse'] = $data['is_reverse'];
        $dataToUpdate['is_image'] = $data['is_image'];
        $dataToUpdate['video'] = $data['video'];

        if(!is_null($data['text'])) {
            foreach ($data['text'] as $lang => $value) {
                $dataToUpdate[$lang]['text'] = $value;
            }
        }

        if(isset($data['image']) && isset($data['image']['newImage'])) {
            if(isset($data['image']['image'])) {
                removeImageFromStorage($data['image']['image']);
            }
            $image = downloadImage('/page-media-blocks', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        $pageMediaBlock = PageMediaBlock::where('page_id', $pageID)->where('number', $number)->first();

        if(!is_null($pageMediaBlock)) {
            $pageMediaBlock->update($dataToUpdate);
        } else {
            $dataToUpdate['number'] = $number;
            $dataToUpdate['page_id'] = $pageID;
            PageMediaBlock::create($dataToUpdate);
        }
    }
    
}