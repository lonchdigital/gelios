<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'page_id',
        'type',
        'slug',
        'show_in_footer',
        'image',
    ];

    public $translatedAttributes = [
        'title',
        'name',
        'description',
        'text'
    ];

    public function pageBlocks(): HasMany
    {
        return $this->hasMany(PageBlock::class);
    }
}
