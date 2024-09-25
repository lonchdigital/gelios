<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SurgeryBlock extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'surgery_id',
        'image',
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
