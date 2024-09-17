<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleBlockTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_block_id',
        'locale',
        'first_title',
        'first_content',
        'second_title',
        'second_content',
    ];
}
