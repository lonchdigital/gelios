<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_id',
        'locale',
        'title',
        'description'
    ];
}
