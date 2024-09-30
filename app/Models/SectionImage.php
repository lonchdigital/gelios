<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionImage extends Model
{
    protected $fillable = [
        'page_id',
        'sort',
        'type',
        'image'
    ];
}
