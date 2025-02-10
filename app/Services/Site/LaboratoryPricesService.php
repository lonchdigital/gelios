<?php

namespace App\Services\Site;

use App\Models\LabPriceCategory;
use App\Models\Page;
use App\Models\Test;
use Illuminate\Http\Request;


class LaboratoryPricesService
{

    public function getFilteredItems(Request $request): array
    {
        $query = LabPriceCategory::query();

        // $query->where('page_id', $page->id);

        if ( !is_null($request['query']['search']) ) {
            $searchTerm = str_replace(' ', '\s*', $request['query']['search']);
            $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);

            $query->where(function ($query) use ($searchTerm) {
                // test translations table
                $query->whereHas('translations', function ($query) use ($searchTerm) {
                    $query->where('title', 'REGEXP', '.*' . $searchTerm . '.*');
                })
                // price translations table
                ->orWhereHas('labPriceItems.translations', function ($query) use ($searchTerm) {
                    $query->where('title', 'REGEXP', '.*' . $searchTerm . '.*')
                        ->where('price', 'REGEXP', '.*' . $searchTerm . '.*');
                });
            });
        }

        $itemsToDisplay = $this->getItemsAdditional($query->get());

        return [
            'items' => $itemsToDisplay
        ];
    }

    private function getItemsAdditional($items)
    {
        foreach($items ?? [] as $item) {
            $additionalInfo = [];

            foreach($item->labPriceItems as $price) {
                $additionalInfo[] = $price;
            }

            $item->setAttribute('additional_info', $additionalInfo);
        }

        return $items;
    }
}
