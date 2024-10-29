<?php

namespace App\Livewire\Admin\CommonBlocks;

use Livewire\Component;
use App\Models\BriefBlock;
use Livewire\WithFileUploads;
use App\Services\Admin\CommonBlocksService;

class Directions extends Component
{
    use WithFileUploads;

    public array $contentData = [];

    protected CommonBlocksService $commonBlocksService;

    public function mount() 
    {
        $this->commonBlocksService = new CommonBlocksService;
        $this->dispatch('livewire:load');

        $directionsData = BriefBlock::where('type', 'directions')->first();
        $this->contentData = $this->commonBlocksService->setDirectionsData($directionsData);
    }

    public function hydrate()
    {
        $this->commonBlocksService = app(CommonBlocksService::class);
    }
    
    public function updated()
    {}

    protected function rules(): array
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules['contentData.title.' . $locale] = [
                'required',
                'string',
                'max:255'
            ];
            $rules['contentData.description.' . $locale] = [
                'nullable',
                'string',
            ];
        }

        return $rules;
    }

    protected function attributes()
    {
        $attributes = [];

        foreach (config('translatable.locales') as $locale) {
            $attributes['contentData.title.' . $locale] = trans('admin.title') . ' ('. $locale .')';
            $attributes['contentData.description.' . $locale] = trans('admin.description') . ' ('. $locale .')';
        }

        return $attributes;
    }

    public function getValidationAttributes()
    {
        return $this->attributes();
    }

    public function save()
    {
        $this->validate();

        $briefBlock = BriefBlock::where('type', 'directions')->first();
        $this->commonBlocksService->updateDirectionsData($briefBlock, $this->contentData);

        redirect()->route('common-blocks.directions')->with('success', trans('admin.document_updated'));
    }

    public function render()
    {
        return view('livewire.admin.common-blocks.directions');
    }

}