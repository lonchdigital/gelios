<?php

namespace App\Livewire\Admin\Vacancy;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Vacancy;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Page $page2;

    public function mount()
    {
        $this->page2 = Page::where('type', PageType::OPENING->value)->first();
    }

    public function getVacanciesProperty()
    {
        $vacancy = Vacancy::paginate(10);

        return $vacancy;
    }

    public function render()
    {
        return view('livewire.admin.vacancy.index');
    }
}
