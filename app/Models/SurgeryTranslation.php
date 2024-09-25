<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'surgery_id',
        'locale',
        'title',
    ];
}
