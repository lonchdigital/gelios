<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title'
    ];
}
