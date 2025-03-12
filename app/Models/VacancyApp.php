<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'phone',
        'vacancy',
    ];

    public function scopeSearch($query, $val)
    {
        return $query->when($val, function($q) use ($val) {
            $q->where('name', 'like', "%$val%")
                ->orWhere('phone', 'like', "%$val%")
                ->orWhere('vacancy', 'like', "%$val%");
        });
    }

    public function getStatusClassAttribute()
    {
        switch ($this->status) {
            case 'new':
                return "text-success";
                break;

            case 'in_processing':
                return "text-warning";
                break;

            case 'confirmed':
                return "text-primary";
                break;

            default:
            return "text-secondary";
                break;
        }
    }
}
