<?php

namespace App\Livewire\Admin\OneCenter;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\OneCenter\OneCenterService;

class Index extends Component
{
    use WithFileUploads;

    public Collection $pages;

    protected oneCenterService $oneCenterService;

    public function mount() 
    {
        $this->oneCenterService = app(OneCenterService::class);

    }

    public function hydrate()
    {
        $this->oneCenterService = app(OneCenterService::class);
    }
    
    public function updated()
    {}

    public function removeOneCenterFromDB($id)
    {
        $this->oneCenterService->removeOneCenter($id);

        redirect()->route('one.center.index')->with('success', trans('admin.page_deleted'));
    }


    public function render()
    {
        return view('livewire.admin.one-center.index');
    }

}