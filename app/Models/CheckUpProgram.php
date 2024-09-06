<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUpProgram extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'check_up_id',
    ];

    public $translatedAttributes = [
        'title',
        'options',
    ];
}
