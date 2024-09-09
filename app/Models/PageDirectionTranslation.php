<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageDirectionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'name',
        'description',
        'text',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
