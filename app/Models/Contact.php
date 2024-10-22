<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Directions\DirectionsService;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Contact extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'city',
        'street',
        'title',
        'text'
    ];
    protected $fillable = [
        'iframe',
        'image'
    ];

    protected ?DirectionsService $directionsService = null;

    public function directionsService(): DirectionsService
    {
        if ($this->directionsService === null) {
            $this->directionsService = app(DirectionsService::class);
        }

        return $this->directionsService;
    }

    public function items()
    {
        return $this->hasMany(ContactItem::class)->orderBy('sort');
    }

    public function gallery()
    {
        return $this->hasMany(ContactGallery::class)->orderBy('sort');
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'contact_directions');
    }

    public function getDirectionsTree()
    {
        $contactDirections = $this->directions()->with('children.children')->get();

        $allDirections = $this->directionsService()->getAllDirectionsWithParents($contactDirections);

        return $this->directionsService()->buildTree($allDirections, true);
    }
    
}
