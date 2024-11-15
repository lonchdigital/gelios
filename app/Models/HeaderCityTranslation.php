<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderCityTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_city_id',
        'locale',
        'title',
    ];
}
