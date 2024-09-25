<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PageBlock extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'page_id',
        'block',
        'key',
        'url',
        'image',
        'images'
    ];

    public $translatedAttributes = [
        'title',
        'content',
        'description',
        'button'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
