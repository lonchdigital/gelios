<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Promotion extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'image',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'price',
        'slug'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?? 'slug';

        if (is_numeric($value)) {
            return $this->where('id', $value)->firstOrFail();
        }

        return $this->whereTranslation($field, $value)->firstOrFail();
    }
}
