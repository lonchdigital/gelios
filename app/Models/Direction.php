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
        return $this->hasMany(Direction::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Direction::class, 'parent_id');
    }
}