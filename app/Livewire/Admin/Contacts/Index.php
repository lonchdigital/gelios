<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Page;
use App\Enums\PageType;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\Livewire\SeoPages;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Admin\Contacts\ContactsService;

class Index extends Component
{
    use WithPagination, WithFileUploads, SeoPages;

    public Page $page;
    public array $sectionData = [];
    public array $pageData = [];

    public array $seoData = [];

    protected ContactsService $contactsService;


    public function mount()
    {
        $this->contactsService = app(ContactsService::class);
        $this->dispatch('livewire:load');

        $this->page = Page::where('type', PageType::CONTACTS->value)->first();

        // Set page data
        $this->pageData = $this->contactsService->setPageData($this->page);

        // Set SEO data
        $this->seoData = $this->setSeoDataPage($this->page);
    }

    public function hydrate()
    {
        $this->contactsService = app(ContactsService::class);
    }



    public function removeContactFromDB(int $contactID)
    {
        $this->contactsService->removeContact($contactID);

        redirect()->route('contacts.index')->with('success', trans('admin.deleted_contact'));
    }

    protected function rules()
    {
        return [

        ];
    }

    public function save()
    {
        // $this->validate();

        $this->contactsService->updatePageData($this->page, $this->pageData);

        $this->updateSeoDataPage($this->page, $this->seoData);

        redirect()->route('contacts.index', $this->page)->with('success', trans('admin.document_updated'));
    }
    
    public function render()
    {
        return view('livewire.admin.contacts.index');
    }
}