<?php

namespace App\Livewire\Admin\VacancyApp;

use App\Models\VacancyApp;
use Livewire\Component;

class OneVacancy extends Component
{
    public VacancyApp $feedback;

    public $statuses = [];

    public string $status = '';

    public function mount(VacancyApp $feedback)
    {
        // $feedback->load('page');

        $this->feedback = $feedback;

        $this->status = $this->feedback->status;

        $this->statuses = [
            'new',
            'confirmed',
        ];
    }

    public function updatedStatus($value)
    {
        $this->feedback->update([
            'status' => $value
        ]);

        $this->dispatch('refreshFeedbackCount');
    }

    public function render()
    {
        return view('livewire.admin.vacancy-app.one-vacancy');
    }
}
