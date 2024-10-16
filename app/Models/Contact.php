<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Contact extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'city',
        'street'
    ];
    protected $fillable = [
        'iframe',
        'image'
    ];

    public function items()
    {
        return $this->hasMany(ContactItem::class)->orderBy('sort');
    }
}
