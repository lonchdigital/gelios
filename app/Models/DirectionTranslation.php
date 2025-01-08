<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'short_name'];
}
