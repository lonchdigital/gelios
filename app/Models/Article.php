<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug',
        'image',
        'images',
        'article_category_id'
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function getImagesUrlAttribute()
    {
        $array = [];

        foreach($this->images as $image) {
            $array[] = Storage::disk('public')->url($image);
        }

        return $array;
    }

    public function articleBlocks(): HasMany
    {
        return $this->hasMany(ArticleBlock::class);
    }
}
