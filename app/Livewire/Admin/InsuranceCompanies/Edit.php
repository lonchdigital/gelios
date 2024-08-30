<?php

namespace App\Livewire\Admin\InsuranceCompanies;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class Edit extends Component
{
    use WithFileUploads;

    public array $companiesRowOne;
    // public Collection $companiesRowTwo;
    
    public function mount() {
        $companiesRowOne = InsuranceCompany::where('row', 1)->get();
        // $companiesRowTwo = InsuranceCompany::where('row', 2)->get();
        
        $i = 1;
        foreach($companiesRowOne as $companyRowOne) {
            $companyRowOne->update([
                'sort' => $i,
            ]);

            $i += 1;
        }

        // $this->companiesRowOne = $companiesRowOne;
        // $this->companiesRowTwo = $companiesRowTwo;

        foreach($companiesRowOne as $companyRowOne2) {
            $this->companiesRowOne[] = [
                'sort' => $companyRowOne2->sort,
                'image' => $companyRowOne2->image,
                'fields' => $companyRowOne2->getTranslationsArray(),
            ];
        }

        // $this->companiesRowOne = $this->companiesRowOne->sortBy('sort');
        usort($this->companiesRowOne, function ($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });
        
    }

    public function newPositionRowOne($val, $index)
    {

        $this->companiesRowOne[$index + $val]['sort'] = $this->companiesRowOne[$index]['sort'];

        $this->companiesRowOne[$index]['sort'] = $this->companiesRowOne[$index]['sort'] + $val;

        usort($this->companiesRowOne, function ($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });






        // dd($val, $index);
        // $this->companiesRowOne[$index + $val]->sort = $this->companiesRowOne[$index]->sort;

        // $this->companiesRowOne[$index]->sort = $this->companiesRowOne[$index]->sort + $val;

        // $this->companiesRowOne = $this->companiesRowOne->sortBy('sort')->values();

        // dd($this->companiesRowOne);
        // $i = 1;
        // foreach($this->companiesRowOne as $companyRowOne) {
        //     // $companyRowOne->sort = $i;
        //     $companyRowOne[$i];
        //     $i += 1;
        // }
    }

    public function render()
    {
        return view('livewire.admin.insurance-companies.edit');
    }

}
