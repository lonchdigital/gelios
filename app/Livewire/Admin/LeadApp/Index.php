<?php

namespace App\Livewire\Admin\LeadApp;

use App\Models\LeadRequest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function paginationView()
    {
        return 'vendor.pagination.plain';
    }

    public function getFeedbacksProperty()
    {
        $feedbacks = LeadRequest::search(trim($this->search))
            ->latest()
            ->paginate(10);

        return $feedbacks;
    }

    public function render()
    {
        return view('livewire.admin.lead-app.index');
    }
}
