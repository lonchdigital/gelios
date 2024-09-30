<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'text_one',
        'text_two'
    ];
}
