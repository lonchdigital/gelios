<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Vacancy extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'is_active',
        'sort',
        'image'
    ];

    public $translatedAttributes = [
        'vacancy_id',
        'locale',
        'title',
        'description'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
