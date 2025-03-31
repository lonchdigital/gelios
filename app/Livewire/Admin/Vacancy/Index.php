<?php

namespace App\Livewire\Admin\Vacancy;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Vacancy;
use App\Services\Admin\Vacancy\VacancyService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Page $page2;

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function paginationView()
    {
        return 'vendor.pagination.plain';
    }

    public function mount()
    {
        $this->page2 = Page::where('type', PageType::OPENING->value)->first();
    }

    public function getVacanciesProperty()
    {
        $vacancy = Vacancy::paginate(10);

        return $vacancy;
    }

    public function changeActive($id)
    {
        $service = resolve(VacancyService::class);

        $service->changeIsActive($id);
    }

    public function deleteItem($id, $type)
    {
        $this->dispatch('openModalDeleteItem', $type, $id);
    }

    public function refreshItemsAfterDelete()
    {
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.admin.vacancy.index');
    }
}
