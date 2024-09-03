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
    // public Collection $companiesRowTwo;
    protected InsuranceCompaniesService $insuranceCompaniesService;
    
    public function mount(InsuranceCompaniesService $insuranceCompaniesService) 
    {
        $companiesRowOne = InsuranceCompany::where('row', 1)->orderBy('sort', 'asc')->get();
        // $companiesRowTwo = InsuranceCompany::where('row', 2)->get();

        updateSort($companiesRowOne);
        
        foreach($companiesRowOne as $companyRowOneItem) {
            $this->companiesRowOne[] = [
                'id' => $companyRowOneItem->id,
                'sort' => $companyRowOneItem->sort,
                'oldImage' => $companyRowOneItem->image ?? '',
                'newImage' => null,
                'image' => $companyRowOneItem->image,
                // 'fields' => $companyRowOne2->getTranslationsArray(),
            ];
        }
        
        $this->companiesRowOne = makeUsort($this->companiesRowOne);
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

    public function updated($propertyName)
    {
        if (preg_match('/companiesRowOne\.\d+\.newImage/', $propertyName)) {
            $this->handleImageChangeForRowOne($propertyName);
        }
        if (preg_match('/companiesRowTwo\.\d+\.newImage/', $propertyName)) {
            // $this->handleImageChangeForRowTwo($propertyName);
        }
    }

    protected function handleImageChangeForRowOne($propertyName)
    {
        preg_match('/companiesRowOne\.(\d+)\.newImage/', $propertyName, $matches);
        $index = $matches[1];

        $this->companiesRowOne[$index]['temporaryImage'] = $this->companiesRowOne[$index]['newImage']->temporaryUrl();
    }

    public function deleteImageRowOne($index)
    {
        $this->companiesRowOne[$index]['image'] = null;
        $this->companiesRowOne[$index]['temporaryImage'] = null;
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

    public function addElementRowOne()
    {
        $this->companiesRowOne[] = [
            'id' => null,
            'image' => null,
            'newImage' => null,
            'sort' => count($this->companiesRowOne) + 1,
        ];
    }

    protected function rules()
    {
        return [
            'companiesRowOne.*.newImage' => [
                'nullable'
            ]
        ];
    }

    public function save()
    {
        $this->validate();

        $existingCompaniesRowOne = InsuranceCompany::where('row', 1)->get();
        $this->insuranceCompaniesService->syncCompanies($this->companiesRowOne, $existingCompaniesRowOne, 1);

        redirect()->route('insurance.companies.index')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.insurance-companies.edit');
    }

}
