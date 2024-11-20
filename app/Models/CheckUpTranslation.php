<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUpTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_up_id',
        'locale',
        'title',
        'description',
        'slug'
    ];
}
