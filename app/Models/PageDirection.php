<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PageDirection extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'description',
        'text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'seo_text',
    ];
    protected $fillable = [
        'slug'
    ];
}
