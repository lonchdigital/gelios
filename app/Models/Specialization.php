<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'title',
    ];

    public function scopeSearch($query, $val)
    {
        return $query->when($val, function($q) use ($val) {
            $q->whereHas('translations', function($q2) use ($val) {
                $q2->where('title', 'like', "%$val%");
            });
        });
    }
}
