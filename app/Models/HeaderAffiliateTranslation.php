<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderAffiliateTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_city_id',
        'locale',
        'address',
    ];
}
