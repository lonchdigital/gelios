<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPriceItemTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_price_item_id',
        'locale',
        'title',
        'price'
    ];
}
