<?php

namespace App\Traits\Livewire;

use App\Models\Page;
use App\Models\PageBlock;

trait HandlesSectionProgress
{
    public function deleteImageSectionProgress($index)
    {
        $this->sectionProgress[$index]['image'] = null;
        $this->sectionProgress[$index]['temporaryImage'] = null;
    }

    public function setSectionProgress(Page|null $page, string $block) : array
    {
        $data = [];

        if( !is_null($page) ) {
            $pageBlocks = PageBlock::where('page_id', $page->id)->where('block', $block)->get();
            
            if( count($pageBlocks) > 0 ){

                foreach($pageBlocks as $pageBlock) {

                    if( !is_null($pageBlock->title) ) {
                        foreach ($pageBlock->getTranslationsArray() as $lang => $value) {
                            $data[$pageBlock->key]['title'][$lang] = $value['title'];
                        }
                    } else {
                        $data[$pageBlock->key]['title'] = [];
                    }

                    if( !is_null($pageBlock->description) ) {
                        foreach ($pageBlock->getTranslationsArray() as $lang => $value) {
                            $data[$pageBlock->key]['description'][$lang] = $value['description'];
                        }
                    } else {
                        $data[$pageBlock->key]['description'] = [];
                    }
                }

                $data['media']['image'] = $pageBlocks->firstWhere('key', 'image')->image;

            } else {
                $data['first'] = [
                    'title' => [],
                    'description' => [],
                ];
                $data['second'] = [
                    'title' => [],
                    'description' => [],
                ];
                $data['third'] = [
                    'title' => [],
                    'description' => [],
                ];
                $data['fourth'] = [
                    'title' => [],
                    'description' => [],
                ];
            }

        }
        
        return $data;
    }

    public function updateSectionProgress(array $items, int $pageID, string $block)
    {
        $pageBlocks = PageBlock::where('page_id', $pageID)->where('block', $block)->get();
        $media = $items['media'] ?? null;
        unset($items['media']);

        foreach($items as $key => $item) {
            $data = [];

            if( !is_null($item['title']) ) {
                foreach ($item['title'] as $lang => $value) {
                    $data[$lang]['title'] = $value;
                }
            }
            if( !is_null($item['description']) ) {
                foreach ($item['description'] as $lang => $value) {
                    $data[$lang]['description'] = $value;
                }
            }

            $pageBlock = $pageBlocks->firstWhere('key', $key);
            if ($pageBlock) {
                $pageBlock->update($data);
            } else {
                $data['page_id'] = $pageID;
                $data['block'] = $block;
                $data['key'] = $key;

                PageBlock::create($data);
            }
        }

        // Image
        $pageBlockImage = PageBlock::where('page_id', $pageID)
            ->where('block', $block)
            ->where('key', 'image')
            ->first();

        $dataToUpdate = [];
        $data['image'] = $media;

        if(isset($data['image']) && isset($data['image']['newImage'])) {
            if(isset($data['image']['image'])) {
                removeImageFromStorage($data['image']['image']);
            }
            $image = downloadImage('/hospitals', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        if ($pageBlockImage) {
            $pageBlockImage->update($dataToUpdate);
        } else {
            $dataToUpdate['page_id'] = $pageID;
            $dataToUpdate['block'] = $block;
            $dataToUpdate['key'] = 'image';

            PageBlock::create($dataToUpdate);
        }
        
    }
    
}