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
        'street',
        'title',
        'text'
    ];
    protected $fillable = [
        'iframe',
        'image'
    ];

    public function items()
    {
        return $this->hasMany(ContactItem::class)->orderBy('sort');
    }

    public function gallery()
    {
        return $this->hasMany(ContactGallery::class)->orderBy('sort');
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'contact_directions');
    }
}
