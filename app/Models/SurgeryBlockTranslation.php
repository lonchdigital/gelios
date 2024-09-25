<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryBlockTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'surgery_block_id',
        'locale',
        'title',
        'description',
    ];
}
