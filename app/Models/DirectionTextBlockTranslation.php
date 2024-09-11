<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectionTextBlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'text_one',
        'text_two'
    ];
}
