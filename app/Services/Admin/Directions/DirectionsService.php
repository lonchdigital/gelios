<?php

namespace App\Services\Admin\Directions;

use App\Models\Direction;
use App\Models\PageDirection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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

}