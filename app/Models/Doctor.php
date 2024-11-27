<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Doctor extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'specalization_id',
        'doctor_category_id',
        'image',
        'images',
        'age',
        'expirience',
        'is_show_in_main_page'
    ];

    protected $translatedAttributes = [
        'doctor_id',
        'locale',
        'title',
        'specialty',
        'education',
        'content',
        'slug',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function getImagesUrlAttribute()
    {
        $array = [];

        foreach($this->images as $image) {
            $array[] = Storage::disk('public')->url($image);
        }

        return $array;
    }

    public function scopeMainPage($query)
    {
        return $query->where('is_show_in_main_page', 1);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function reviews()
    {
        return $this->morphToMany(Review::class, 'reviewable');
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
