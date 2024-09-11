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

}