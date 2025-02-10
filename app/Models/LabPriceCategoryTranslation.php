<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPriceCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_price_category_id',
        'locale',
        'title',
    ];
}
