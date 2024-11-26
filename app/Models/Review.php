<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Review extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'text'
    ];
    protected $fillable = [
        'published',
        'image'
    ];

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'reviewable');
    }

    public function doctors()
    {
        return $this->morphedByMany(Doctor::class, 'reviewable');
    }
}
