<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class CheckUp extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'price',
        'new_price',
        'image',
        'show_in_footer',
        'image',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'slug'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function checkUpPrograms(): HasMany
    {
        return $this->hasMany(CheckUpProgram::class);
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
