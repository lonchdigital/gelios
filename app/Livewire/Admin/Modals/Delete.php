<?php

namespace App\Livewire\Admin\Modals;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public bool $isOpen = false;

    public $item = null;
    public $type = '';
    public $modalTitle = '';
    public $modalBody = '';
    public $modalInfo = '';
    public $withRedirect;

    protected $listeners = [
        'refresh' => '$refresh',
        'openModalDeleteItem' => 'openModal',
    ];

    public function openModal($modelName, $modelId, $withRedirect = false)
    {
        $this->withRedirect = $withRedirect;

        switch ($modelName) {
            case 'user':
                $this->item = User::find($modelId);
                $this->type = 'user';
                $this->modalTitle = 'Delete user';
                $this->modalBody  = 'You really want to delete user: ' . $this->item->name . $this->item->second_name . '?';
                $this->modalInfo  = '';
                break;

            default:

                break;
        }

        $this->isOpen   = true;
        $this->dispatch('showModal', 'openModalConfirmDelete');
    }

    public function closeModal()
    {
        $this->isOpen   = false;
        $this->dispatch('closeModal', 'closeModalConfirmDelete');
    }

    public function confirmDelete()
    {
        if ($this->item && $this->itemDelete()) {
            $this->closeModal();
            $this->dispatch('showAlert', 'success', 'Successfuly deleted!');
            $this->dispatch('refreshItemsAfterDelete');

            return true;
        }

        $this->dispatch('showAlert', 'warning', 'Can\'t delete!');
        $this->closeModal();
        return false;
    }

    public function itemDelete()
    {
        switch ($this->type) {
            case 'user':

                $this->item->delete();

                $this->item->refresh();

                return true;

            default:

                return false;
        }
    }

    public function deleteImage($image)
    {
        Storage::disk('public')->delete($image);
    }


    public function render()
    {
        return view('livewire.admin.modals.delete');
    }
}
