<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeaderCity extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'first_phone',
        'second_phone',
    ];

    public $translatedAttributes = [
        'title',
    ];

    public function headerAffiliates(): HasMany
    {
        return $this->hasMany(HeaderAffiliate::class);
    }
}
