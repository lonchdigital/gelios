<?php

namespace App\Livewire\Admin\VacancyApp;

use App\Models\VacancyApp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function getFeedbacksProperty()
    {
        $feedbacks = VacancyApp::search(trim($this->search))
            ->latest()
            ->paginate(10);

        return $feedbacks;
    }

    public function render()
    {
        return view('livewire.admin.vacancy-app.index');
    }
}
