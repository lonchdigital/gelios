<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Direction extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'short_name'];

    protected $fillable = [
        'page_direction_id',
        'parent_id',
        'sort',
        'template',
        'in_footer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            foreach (config('translatable.locales') as $locale):
                Cache::forget("all_directions_{$locale}");
                Cache::forget("all_directions_dashboard_{$locale}");
            endforeach;
        });

        static::deleted(function () {
            foreach (config('translatable.locales') as $locale):
                Cache::forget("all_directions_{$locale}");
                Cache::forget("all_directions_dashboard_{$locale}");
            endforeach;
        });
    }

    public function children()
    {
        return $this->hasMany(Direction::class, 'parent_id')->orderBy('sort');
    }

    public function parent()
    {
        return $this->belongsTo(Direction::class, 'parent_id');
    }

    public function page()
    {
        return $this->belongsTo(PageDirection::class, 'page_direction_id', 'id');
    }

    public function textBlocks()
    {
        return $this->hasMany(DirectionTextBlock::class);
    }

    public function prices()
    {
        return $this->hasMany(DirectionPrice::class)->orderBy('sort');
    }

    public function infoBlocks()
    {
        return $this->hasMany(DirectionInfoBlock::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_directions');
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'direction_doctors', 'direction_id', 'doctor_id');
    }

    public function getDoctors() : Collection
    {
        if( count($this->doctors) > 0 ) {
            $doctors = $this->doctors;
        } else {
            $doctors = Doctor::limit(10)->get();
        }

        return $doctors;
    }

    public function scopeSearch($query, $val)
    {
        return $query->when($val, function($q) use ($val) {
            $q->whereHas('translations', function($q2) use ($val) {
                $q2->where('name', 'like', "%$val%");
            });
        });
    }

    public function buildBreadcrumbs()
    {
        $breadcrumbs = [];
        $current = $this;

        while ($current) {
            $breadcrumbs[] = [
                'id' => $current->id,
                'name' => $current->short_name ?? null,
                'slug' => $current->page->slug ?? null,
                'full_path' => url($current->buildFullPath())
            ];
            $current = $current->parent; // parent
        }

        return array_reverse($breadcrumbs);
    }

    public function buildFullPath(): string
    {
        $segments = [];
        $current = $this;

        while ($current) {
            $segments[] = $current->page->slug ?? null;
            $current = $current->parent; // parent
        }

        return implode('/', array_reverse($segments)); // full path
    }
}
