<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'locale',
        'specialization_id',
    ];
}
