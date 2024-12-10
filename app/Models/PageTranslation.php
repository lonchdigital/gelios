<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'locale',
        'title',
        'sub_title',
        'name',
        'description',
        'text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'seo_title',
        'seo_text'
    ];
}
