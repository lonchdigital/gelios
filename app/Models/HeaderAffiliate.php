<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderAffiliate extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'header_city_id',
        'first_phone',
        'second_phone',
        'email',
        'hours',
        'latitude',
        'longitude',
    ];

    public $translatedAttributes = [
        'address',
    ];
}
