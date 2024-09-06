<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlockTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_block_id',
        'locale',
        'title',
        'description',
        'content',
        'button',
    ];
}
