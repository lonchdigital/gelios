<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'locale',
        'title',
        'expirience',
        'specialty',
        'education',
        'doctor',
        'slug',
        'content',
        'seo_title',
        'seo_description',
    ];
}
