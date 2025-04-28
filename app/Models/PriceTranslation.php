<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['service', 'price'];
}
