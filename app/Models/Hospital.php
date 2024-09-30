<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Hospital extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'text_one',
        'text_two'
    ];
    protected $fillable = [
        'is_reverse',
        'is_image',
        'image'
    ];
}
