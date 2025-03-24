<?php

namespace App\Livewire\Admin\LeadApp;

use App\Models\LeadRequest;
use Livewire\Component;

class OneLead extends Component
{
    public LeadRequest $feedback;

    public $statuses = [];

    public string $status = '';

    public function mount(LeadRequest $feedback)
    {
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
        return view('livewire.admin.lead-app.one-lead');
    }
}
