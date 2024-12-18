<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContactItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'sort',
        'type',
        'item'
    ];
}
