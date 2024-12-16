<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_slider_id',
        'locale',
        'title',
        'description',
    ];
}
