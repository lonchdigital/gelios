<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ArticleSlider extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'article_id',
        'image',
        'sort',
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
