<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'doctor_specialist',
        'clinic_name',
        'type',
        'status',
    ];

    public function scopeSearch($query, $val)
    {
        return $query->when($val, function($q) use ($val) {
            $q->where('name', 'like', "%$val%")
                ->orWhere('phone', 'like', "%$val%")
                ->orWhere('doctor_specialist', 'like', "%$val%")
                ->orWhere('clinic_name', 'like', "%$val%");
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
