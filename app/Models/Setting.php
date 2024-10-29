<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'key',
        'value',
    ];

    public $translatedAttributes = [
        'text',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->value);
    }
}
