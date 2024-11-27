<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorCategory extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'type'
    ];

    public $translatedAttributes = [
        'title',
    ];
}
