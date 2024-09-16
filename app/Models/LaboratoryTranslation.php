<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'locale',
        'laboratory_id',
    ];
}
