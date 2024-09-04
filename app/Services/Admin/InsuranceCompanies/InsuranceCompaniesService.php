<?php

namespace App\Services\Admin\InsuranceCompanies;

use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Collection;

class InsuranceCompaniesService 
{

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