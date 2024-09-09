<?php

namespace App\DataClasses;


class DirectionTemplateTypeClass implements BaseDataClass
{
    const CATEGORY = 1;
    const SUB_CATEGORY = 2;
    const DIRECTION = 3;

    public static function get(?int $item = null): mixed
    {
        $collection = collect([
            [
                'id' => self::CATEGORY,
                'name' => trans('admin.category'),
            ],
            [
                'id' => self::SUB_CATEGORY,
                'name' => trans('admin.sub_category'),
            ],
            [
                'id' => self::DIRECTION,
                'name' => trans('admin.direction'),
            ]
        ]);

        if ($item) {
            return $collection->where('id', $item)->first();
        }

        return $collection;
    }
}
