<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabPriceCategory extends Model
{
    use HasFactory, Translatable;

    protected $translatedAttributes = [
        'title',
    ];

    public function labPriceItems(): HasMany
    {
        return $this->hasMany(LabPriceItem::class);
    }
}
