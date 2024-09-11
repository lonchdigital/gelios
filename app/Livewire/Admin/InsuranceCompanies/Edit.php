<?php

namespace App\Livewire\Admin\InsuranceCompanies;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\InsuranceCompanies\InsuranceCompaniesService;

class Edit extends Component
{
    use WithFileUploads;

    public array $companiesRowOne = [];
    public array $companiesRowTwo = [];
    protected InsuranceCompaniesService $insuranceCompaniesService;
    
    public function mount() 
    {
        $companiesRowOne = InsuranceCompany::where('row', 1)->orderBy('sort', 'asc')->get();
        $companiesRowTwo = InsuranceCompany::where('row', 2)->orderBy('sort', 'asc')->get();

        updateSort($companiesRowOne);
        updateSort($companiesRowTwo);
        
        foreach($companiesRowOne as $companyRowOneItem) {
            $this->companiesRowOne[] = [
                'id' => $companyRowOneItem->id,
                'sort' => $companyRowOneItem->sort,
                'oldImage' => $companyRowOneItem->image ?? '',
                'newImage' => null,
                'image' => $companyRowOneItem->image
            ];
        }
        foreach($companiesRowTwo as $companyRowTwoItem) {
            $this->companiesRowTwo[] = [
                'id' => $companyRowTwoItem->id,
                'sort' => $companyRowTwoItem->sort,
                'oldImage' => $companyRowTwoItem->image ?? '',
                'newImage' => null,
                'image' => $companyRowTwoItem->image,
            ];
        }
        
        $this->companiesRowOne = makeUsort($this->companiesRowOne);
        $this->companiesRowTwo = makeUsort($this->companiesRowTwo);
    }

    public function hydrate()
    {
        $this->insuranceCompaniesService = app(InsuranceCompaniesService::class);
    }

    public function newPositionRowOne($val, $index)
    {
        $this->companiesRowOne[$index + $val]['sort'] = $this->companiesRowOne[$index]['sort'];

        $this->companiesRowOne[$index]['sort'] = $this->companiesRowOne[$index]['sort'] + $val;

        $this->companiesRowOne = makeUsort($this->companiesRowOne);
    }
    public function newPositionRowTwo($val, $index)
    {
        $this->companiesRowTwo[$index + $val]['sort'] = $this->companiesRowTwo[$index]['sort'];

        $this->companiesRowTwo[$index]['sort'] = $this->companiesRowTwo[$index]['sort'] + $val;

        $this->companiesRowTwo = makeUsort($this->companiesRowTwo);
    }
    
    public function updated($propertyName)
    {
        if (preg_match('/companiesRowOne\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForRowOne($propertyName);
        }
        if (preg_match('/companiesRowTwo\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForRowTwo($propertyName);
        }
    }

    protected function handleImageChangeForRowOne($propertyName)
    {
        preg_match('/companiesRowOne\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->companiesRowOne[$index]['temporaryImage'] = $this->companiesRowOne[$index]['newImage']->temporaryUrl();
    }
    protected function handleImageChangeForRowTwo($propertyName)
    {
        preg_match('/companiesRowTwo\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->companiesRowTwo[$index]['temporaryImage'] = $this->companiesRowTwo[$index]['newImage']->temporaryUrl();
    }

    public function deleteImageRowOne($index)
    {
        $this->companiesRowOne[$index]['image'] = null;
        $this->companiesRowOne[$index]['temporaryImage'] = null;
    }
    public function deleteImageRowTwo($index)
    {
        $this->companiesRowTwo[$index]['image'] = null;
        $this->companiesRowTwo[$index]['temporaryImage'] = null;
    }

    public function removeElementRowOne($index)
    {
        foreach($this->companiesRowOne as $index2 => $companyRowOne) {
            if($companyRowOne['sort'] > $this->companiesRowOne[$index]['sort']) {
                $this->companiesRowOne[$index2]['sort'] = $companyRowOne['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->companiesRowOne)) {
            unset($this->companiesRowOne[$index]);
        }
    }
    public function removeElementRowTwo($index)
    {
        foreach($this->companiesRowTwo as $index2 => $companyRowTwo) {
            if($companyRowTwo['sort'] > $this->companiesRowTwo[$index]['sort']) {
                $this->companiesRowTwo[$index2]['sort'] = $companyRowTwo['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->companiesRowTwo)) {
            unset($this->companiesRowTwo[$index]);
        }
    }

    public function addElementRowOne()
    {
        $this->companiesRowOne[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->companiesRowOne) + 1,
        ];
    }
    public function addElementRowTwo()
    {
        $this->companiesRowTwo[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->companiesRowTwo) + 1,
        ];
    }

    protected function rules()
    {
        return [
            'companiesRowOne.*.newImage' => [
                'nullable'
            ],
            'companiesRowTwo.*.newImage' => [
                'nullable'
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        $existingCompaniesRowOne = InsuranceCompany::where('row', 1)->get();
        $existingCompaniesRowTwo = InsuranceCompany::where('row', 2)->get();
        $this->insuranceCompaniesService->syncCompanies($this->companiesRowOne, $existingCompaniesRowOne, 1);
        $this->insuranceCompaniesService->syncCompanies($this->companiesRowTwo, $existingCompaniesRowTwo, 2);

        redirect()->route('insurance.companies.index')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.insurance-companies.edit');
    }

}
