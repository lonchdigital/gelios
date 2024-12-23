<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectionDoctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'direction_id',
    ];
}
