<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectionPriceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['service', 'price'];
}
