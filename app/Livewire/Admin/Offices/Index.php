<?php

namespace App\Livewire\Admin\Offices;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Contacts\ContactsService;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public array $sectionData = [];
    public Collection $contacts;

    protected ContactsService $contactsService;


    public function mount()
    {
        $this->contactsService = app(ContactsService::class);
        $this->dispatch('livewire:load');

        $this->contacts = Contact::all();
    }

    public function hydrate()
    {
        $this->contactsService = app(ContactsService::class);
    }



    public function removeContactFromDB(int $contactID)
    {
        $this->contactsService->removeContact($contactID);

        redirect()->route('offices.index')->with('success', trans('admin.deleted_contact'));
    }

    protected function rules()
    {
        return [

        ];
    }
    
    public function render()
    {
        return view('livewire.admin.offices.index');
    }
}