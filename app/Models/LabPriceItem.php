<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPriceItem extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'lab_price_category_id',
    ];

    protected $translatedAttributes = [
        'title',
        'price',
    ];
}
