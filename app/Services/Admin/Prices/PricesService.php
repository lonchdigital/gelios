<?php

namespace App\Services\Admin\Prices;

use App\Models\Page;
use App\Models\Price;
use App\Models\Test;
use Illuminate\Database\Eloquent\Collection;


class PricesService 
{

    public function setPrices(Collection $prices)
    {
        $data = [];

        foreach($prices as $price) {

            $service = [];
            if(!is_null($price)) {
                foreach ($price->getTranslationsArray() as $lang => $value) {
                    $service[$lang] = $value['service'];
                }
            }

            $priceItself = [];
            if(!is_null($price)) {
                foreach ($price->getTranslationsArray() as $lang => $value) {
                    $priceItself[$lang] = $value['price'];
                }
            }

            $data[] = [
                'id' => $price->id,
                'sort' => $price->sort,
                'price' => $priceItself,
                'service' => $service,
                'is_free' => $price->is_free,
            ];
        }

        return $data;
    }

    public function syncPrices(array $prices, Collection $existingPrices, int $testId)
    {
        foreach( $prices as $price ) {
            $existingPrice = $existingPrices->where('id', $price['id'])->first();

            if( !is_null($existingPrice) ) {
                $dataToUpdate = [
                    'sort' => $price['sort'],
                    'is_free' => $price['is_free']
                ];

                if($price['service']) {
                    foreach ($price['service'] as $lang => $value) {
                        $dataToUpdate[$lang]['service'] = $value;
                    }
                }
                if($price['price']) {
                    foreach ($price['price'] as $lang => $value) {
                        $dataToUpdate[$lang]['price'] = $value;
                    }
                }

                $existingPrice->update($dataToUpdate);
            } else {
                $dataToUpdate = [
                    'test_id' => $testId,
                    'sort' => $price['sort'],
                    'is_free' => $price['is_free']
                ];

                if($price['service']) {
                    foreach ($price['service'] as $lang => $value) {
                        $dataToUpdate[$lang]['service'] = $value;
                    }
                }
                if($price['price']) {
                    foreach ($price['price'] as $lang => $value) {
                        $dataToUpdate[$lang]['price'] = $value;
                    }
                }

                Price::create($dataToUpdate);
            }
        }

        // remove items
        $existingPricesInRequest = $prices ? array_filter(array_column($prices, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $pricesToDelete = $existingPrices->whereNotIn('id', $existingPricesInRequest);

        foreach ($pricesToDelete as $priceToDelete) {
            $priceToDelete->delete();
        }
    }

    public function updateTest(array $data, null|Test $test, Page $page)
    {
        $dataToUpdate = [];

        if(!is_null($data['title'])) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        if(!is_null($test)) {
            $test->update($dataToUpdate);
            return $test;
        } else {
            $dataToUpdate['page_id'] = $page->id;
            return Test::create($dataToUpdate);
        }
    }

    public function removeTest(int $testlID) 
    {
        $test = Test::find($testlID);
        
        $test->delete();
    }

    public function setPageData(Page $page)
    {
        $data = [];

        if( !empty($page->getTranslationsArray()) ) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
        } else {
            $data['title'] = [];
        }

        return $data;
    }

    public function updatePageData(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

}