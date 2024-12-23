<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class DirectionTextBlock extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'text_one',
        'text_two'
    ];
    protected $fillable = [
        'direction_id',
        'number',
        'is_reverse',
        'is_image',
        'image',
        'button_one_url'
    ];
}
