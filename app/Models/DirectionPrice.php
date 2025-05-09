<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class DirectionPrice extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['service', 'price'];
    protected $fillable = ['direction_id', 'sort', 'is_free'];
}
