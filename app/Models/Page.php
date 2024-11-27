<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'page_id',
        'type',
        'slug',
        'show_in_footer',
        'image',
        'video_file',
    ];

    public $translatedAttributes = [
        'title',
        'name',
        'description',
        'text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'seo_title',
        'seo_text'
    ];

    public function pageBlocks(): HasMany
    {
        return $this->hasMany(PageBlock::class);
    }

    public function pageTextBlocks(): HasMany
    {
        return $this->hasMany(PageTextBlock::class);
    }
    
    public function briefBlocks(): HasMany
    {
        return $this->hasMany(BriefBlock::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function reviews()
    {
        return $this->morphToMany(Review::class, 'reviewable');
    }

}
