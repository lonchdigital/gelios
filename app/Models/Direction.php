<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Direction extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = [
        'page_direction_id',
        'parent_id',
        'sort',
        'template'
    ];


    public function children()
    {
        return $this->hasMany(Direction::class, 'parent_id')->orderBy('sort');
    }

    public function parent()
    {
        return $this->belongsTo(Direction::class, 'parent_id');
    }

    public function page()
    {
        return $this->belongsTo(PageDirection::class, 'page_direction_id', 'id');
    }

    public function textBlocks()
    {
        return $this->hasMany(DirectionTextBlock::class);
    }
}
