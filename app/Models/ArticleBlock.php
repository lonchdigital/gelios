<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleBlock extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'article_id',
        'type',
        'sort',
    ];

    public $translatedAttributes = [
        'first_title',
        'first_content',
        'second_title',
        'second_content',
    ];
}
