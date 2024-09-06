<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'locale',
        'article_category_id',
    ];
}
