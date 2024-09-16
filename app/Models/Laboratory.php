<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laboratory extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'laboratody_city_id',
        'phone',
        'hours',
        'email',
    ];

    public $translatedAttributes = [
        'address',
    ];

    public function laboratoryCity(): BelongsTo
    {
        return $this->belongsTo(LaboratoryCity::class);
    }
}
