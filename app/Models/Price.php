<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Price extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['service'];
    protected $fillable = ['test_id', 'sort', 'price'];
}