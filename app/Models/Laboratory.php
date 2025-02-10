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
        'email',
    ];

    public $translatedAttributes = [
        'address',
        'hours',
    ];

    public function laboratoryCity(): BelongsTo
    {
        return $this->belongsTo(LaboratoryCity::class);
    }

    public function getPhonesAttribute()
    {
        return array_map('trim', explode(',', $this->phone));
    }
}
