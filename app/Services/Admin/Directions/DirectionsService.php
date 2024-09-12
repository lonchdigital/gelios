<?php

namespace App\Services\Admin\Directions;

use App\Models\Direction;
use Illuminate\Support\Str;
use App\Models\PageDirection;
use App\Models\DirectionTextBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class DirectionsService 
{
    public function getAllDirections(): Collection
    {
        return Direction::with('children.children')->whereNull('parent_id')->get();
    }

    public function addDirection(array $data)
    {
        DB::transaction(function () use ($data) {
            $page = $this->createPage($data);
            $this->createDirection($data, $page);
        });
    }

    private function createPage(array $data)
    {
        $dataToUpdate = [];

        $dataToUpdate['slug'] = Str::slug($data['directionName']['ua']);

        foreach ($data['directionName'] as $lang => $value) {
            $dataToUpdate[$lang]['name'] = $value;
        }

        $page = PageDirection::create($dataToUpdate);
        return $page;
    }

    private function createDirection(array $data, PageDirection $page)
    {
        $dataToUpdate = [];
        $dataToUpdate['page_direction_id'] = $page->id;
        $dataToUpdate['template'] = $data['directionTemplate'];
        $dataToUpdate['parent_id'] = $data['directionParent'];

        foreach ($data['directionName'] as $lang => $value) {
            $dataToUpdate[$lang]['name'] = $value;
        }

        Direction::create($dataToUpdate);
    }

    public function buildTree($directions)
    {
        $tree = [];

        foreach ($directions as $direction) {
            $children = $direction->children->isNotEmpty() 
                ? $this->buildTree($direction->children) 
                : [];

            $tree[] = [
                'id' => $direction->id,
                'name' => $direction->name,
                'template' => $direction->template,
                'children' => $children,
            ];
        }

        return $tree;
    }

    public function updatePage(PageDirection $page, array $data)
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

    public function updateTextBlock(array $data)
    {
        $dataToUpdate = [];
        $dataToUpdate['direction_id'] = $data['direction_id'];
        $dataToUpdate['number'] = $data['number'];
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

        if(isset($data['image']['newImage'])) {
            removeImageFromStorage($data['image']['image']);
            $image = downloadImage('/directions', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        $existingTextBlock = DirectionTextBlock::where('number', $data['number'])->where('direction_id', $data['direction_id'])->first();

        if(!is_null($existingTextBlock)) {
            $existingTextBlock->update($dataToUpdate);
        } else {
            DirectionTextBlock::create($dataToUpdate);
        }
    }

    public function setTextBlockData(DirectionTextBlock $directionTextBlock)
    {
        $data = [];

        if(!is_null($directionTextBlock)) {
            foreach ($directionTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_one'][$lang] = $value['text_one'];
            }
            foreach ($directionTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_two'][$lang] = $value['text_two'];
            }
            $data['media']['image'] = $directionTextBlock->image;
            $data['is_reverse'] = $directionTextBlock->is_reverse;
            $data['is_image'] = $directionTextBlock->is_image;
        } else {
            $data['text_one'] = [];
            $data['text_two'] = [];
            $data['is_reverse'] = false;
            $data['is_image'] = true;
        }

        return $data;
    }

    public function setSeoData(PageDirection $page)
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

}