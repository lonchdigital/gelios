<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterDirection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_direction_id',
        'is_active',
        'sort',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Direction::class, 'page_direction_id', 'id');
    }
}
