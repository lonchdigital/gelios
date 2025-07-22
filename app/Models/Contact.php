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
        'map_url',
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
        $all = $this->directionsService()->getCachedDirections();
        $validIds = $this->directions()->select('directions.id')->pluck('id')->toArray();

        return $this->filterDirectionsTree($all, $validIds);
    }
    
    private function filterDirectionsTree(\Illuminate\Support\Collection $tree, array $validIds): array
    {
        $filtered = [];

        foreach ($tree as $item) {
            $children = $this->filterDirectionsTree(collect($item['children']), $validIds);

            if (in_array($item['id'], $validIds) || count($children)) {
                $item['children'] = $children;
                $filtered[] = $item;
            }
        }

        return $filtered;
    }
    // TODO:: old version of getDirectionsTree()
    // public function getDirectionsTree()
    // {
    //     $contactDirections = $this->directions()->with('parent')->get();
    //     $allDirections = $this->directionsService()->getAllDirectionsWithParents($contactDirections);

    //     // dd( $contactDirections, $allDirections );

    //     return $this->directionsService()->buildTreeForOneContact(
    //         $allDirections, 
    //         $contactDirections->keyBy('id')
    //     );
    // }

    
}
