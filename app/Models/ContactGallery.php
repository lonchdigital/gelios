<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGallery extends Model
{
    protected $fillable = [
        'contact_id',
        'sort',
        'image'
    ];
}
