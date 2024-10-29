<?php

namespace App\Services\Admin;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\BriefBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class CommonBlocksService 
{
    public function setDirectionsData(null|BriefBlock $blockData)
    {
        $data = [];

        if(!is_null($blockData)) {
            foreach ($blockData->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
            foreach ($blockData->getTranslationsArray() as $lang => $value) {
                $data['description'][$lang] = $value['description'];
            }
        } else {
            $data['title'] = [];
            $data['description'] = [];
        }

        return $data;
    }

    public function updateDirectionsData(null|BriefBlock $briefBlock, array $data)
    {
        $dataToUpdate = [];

        if(!is_null($data['title'])) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }
        if(!is_null($data['description'])) {
            foreach ($data['description'] as $lang => $value) {
                $dataToUpdate[$lang]['description'] = $value;
            }
        }

        if(!is_null($briefBlock)) {
            $briefBlock->update($dataToUpdate);
        } else {
            $page = Page::where('type', PageType::DIRECTIONS->value)->first();
            $dataToUpdate['type'] = 'directions';
            $dataToUpdate['page_id'] = $page->id;

            BriefBlock::create($dataToUpdate);
        }
    }

}