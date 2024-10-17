<?php

namespace App\Livewire\Admin\Prices\Tests;

use App\Models\Page;
use App\Models\Test;
use App\Enums\PageType;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\Admin\Prices\PricesService;


class Edit extends Component
{
    use WithFileUploads;

    public Test|null $test = null;

    public Page $page;
    public array $sectionData = [];
    public array $prices = [];

    protected PricesService $pricesService;
    
    public function mount() 
    {
        $this->pricesService = app(PricesService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::PRICES->value)->first();

        if(!is_null($this->test)) {

            // set title
            $data = [];
            foreach ($this->test->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
            $this->sectionData = $data;

            // set prices
            $prices = $this->test->prices;
            updateSort($prices);

            $this->prices = $this->pricesService->setPrices($prices);
            $this->prices = makeUsort($this->prices);

        } else {
            $data['title'] = [];
            $this->sectionData = $data;

            $this->prices = [];
        }
        
    }

    public function hydrate()
    {
        $this->pricesService = app(PricesService::class);
    }

    public function newPositionPrices($val, $index)
    {
        $this->prices[$index + $val]['sort'] = $this->prices[$index]['sort'];

        $this->prices[$index]['sort'] = $this->prices[$index]['sort'] + $val;

        $this->prices = makeUsort($this->prices);
    }
    public function removeElementPrices($index)
    {
        foreach($this->prices as $index2 => $priceItem) {
            if($priceItem['sort'] > $this->prices[$index]['sort']) {
                $this->prices[$index2]['sort'] = $priceItem['sort'] - 1;
            }
        }

        if (array_key_exists($index, $this->prices)) {
            unset($this->prices[$index]);
        }
    }
    public function addElementPrices()
    {
        $this->prices[] = [
            'id' => null,
            'sort' => count($this->prices) + 1,
            'price' => 0,
            'service' => []
        ];
    }

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();

    
        $formData = [
            'title' => $this->sectionData['title'],
        ];
        $currentTest = $this->pricesService->updateTest($formData, $this->test, $this->page);
        
        // Update Prices
        $existingPrices = $currentTest->prices;
        $this->pricesService->syncPrices($this->prices, $existingPrices, $currentTest->id);

        redirect()->route('prices.index')->with('success', trans('admin.added_test'));
    }

    public function render()
    {
        return view('livewire.admin.prices.tests.edit');
    }

}
