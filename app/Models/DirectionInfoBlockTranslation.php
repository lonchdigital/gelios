<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectionInfoBlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
