<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PageMediaBlock extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'text'
    ];
    protected $fillable = [
        'page_id',
        'is_reverse',
        'is_image',
        'image',
        'video'
    ];
}
