<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class DirectionInfoBlock extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['direction_id'];
}
