<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalGallery extends Model
{
    protected $fillable = [
        'hospital_id',
        'sort',
        'image'
    ];
}
