<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class InsuranceCompany extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['test'];
    protected $fillable = [
        'row',
        'sort',
        'image'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
