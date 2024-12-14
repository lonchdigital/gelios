<?php

namespace App\Services\Admin\InsuranceCompanies;

use App\Models\Page;
use App\Models\PageContactItem;
use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Collection;

class InsuranceCompaniesService 
{

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

        if( !empty($page->getTranslationsArray()) ) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['sub_title'][$lang] = $value['sub_title'];
            }
        } else {
            $data['sub_title'] = [];
        }

        if( !empty($page->getTranslationsArray()) ) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['description'][$lang] = $value['description'];
            }
        } else {
            $data['description'] = [];
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
        if($data['sub_title']) {
            foreach ($data['sub_title'] as $lang => $value) {
                $dataToUpdate[$lang]['sub_title'] = $value;
            }
        }
        if($data['description']) {
            foreach ($data['description'] as $lang => $value) {
                $dataToUpdate[$lang]['description'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    public function syncItems(array $items, Collection $existingItems, int $pageID, string $type)
    {
        foreach( $items as $oneItem ) {
            $existingItem = $existingItems->where('id', $oneItem['id'])->first();

            if( !is_null($existingItem) ) {
                $dataToUpdate = [];

                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['item'] = $oneItem['item'];
                
                $existingItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [];

                $dataToUpdate['page_id'] = $pageID;
                $dataToUpdate['type'] = $type;
                $dataToUpdate['sort'] = $oneItem['sort'];
                $dataToUpdate['item'] = $oneItem['item'];
    
                PageContactItem::create($dataToUpdate);
            }
        }

        // remove items
        $existingItemsInRequest = $items ? array_filter(array_column($items, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $itemsToDelete = $existingItems->whereNotIn('id', $existingItemsInRequest);

        foreach ($itemsToDelete as $itemToDelete) {
            removeImageFromStorage($itemToDelete->image);
            $itemToDelete->delete();
        }
    }

    public function syncCompanies(array $companies, Collection $existingCompanies, int $row)
    {
        foreach( $companies as $company ) {
            $existingCompany = $existingCompanies->where('id', $company['id'])->first();

            if( !is_null($existingCompany) ) {
                $dataToUpdate = [
                    'sort' => $company['sort']
                ];
                
                $existingCompany->update($dataToUpdate);
            } else {
                $image = null;
                if(isset($company['newImage'])) {
                    $image = downloadImage('/insurance-companies', $company['newImage']);
                }
    
                InsuranceCompany::create([
                    'sort' => $company['sort'],
                    'row' => $row,
                    'image' => $image,
                ]);
            }
        }

        // remove items
        $existingCompaniesInRequest = $companies ? array_filter(array_column($companies, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $companiesToDelete = $existingCompanies->whereNotIn('id', $existingCompaniesInRequest);

        foreach ($companiesToDelete as $companyToDelete) {
            removeImageFromStorage($companyToDelete->image);
            $companyToDelete->delete();
        }
    }

}