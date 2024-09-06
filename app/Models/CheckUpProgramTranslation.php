<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUpProgramTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_up_program_id',
        'locale',
        'title',
        'options'
    ];

    protected $casts = [
        'options' => 'array',
    ];

}
