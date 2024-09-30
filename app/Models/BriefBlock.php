<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class BriefBlock extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title',
        'description'
    ];
    protected $fillable = [
        'page_id',
        'sort',
        'type',
        'image'
    ];
}
