<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'sort',
        'type',
        'item'
    ];
}
