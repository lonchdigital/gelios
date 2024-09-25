<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surgery extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'title',
    ];

    public function surgeryBlocks(): HasMany
    {
        return $this->hasMany(SurgeryBlock::class);
    }
}
