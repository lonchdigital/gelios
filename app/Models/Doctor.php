<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'is_show_in_main_page'
    ];

    protected $translatedAttributes = [
        'doctor_id',
        'locale',
        'title',
        'expirience',
        'specialty',
        'education',
        'content',
        'slug',
        'seo_title',
        'seo_description',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(DoctorCategory::class, 'doctor_category_id', 'id');
    }

    public function directions(): BelongsToMany
    {
        return $this->BelongsToMany(Direction::class, 'direction_doctors', 'doctor_id', 'direction_id');
    }

    public function specializations(): BelongsToMany
    {
        return $this->BelongsToMany(Specialization::class, 'doctor_specializations', 'doctor_id', 'specialization_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?? 'slug';

        if (is_numeric($value)) {
            return $this->where('id', $value)->firstOrFail();
        }

        return $this->whereTranslation($field, $value)->firstOrFail();
    }

    public function scopeSearch($query, $val)
    {
        return $query->when($val, function($q) use ($val) {
            $q->whereHas('translations', function($q2) use ($val) {
                $q2->where('title', 'like', "%$val%");
            });
        });
    }

    public function getAgeWithWord(): string
    {
        $age = $this->age;
        $word = $this->getAgeWord($age);
        return "{$age} {$word}";
    }

    private function getAgeWord(int $age): string
    {
        $mod10 = $age % 10;
        $mod100 = $age % 100;

        if ($mod100 >= 11 && $mod100 <= 14) {
            return __('web.years');
        }
        if ($mod10 == 1) {
            return __('web.one_year');
        }
        if ($mod10 >= 2 && $mod10 <= 4) {
            return __('web.two_years');
        }

        return __('web.years');
    }
}
