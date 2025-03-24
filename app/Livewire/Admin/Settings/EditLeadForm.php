<?php

namespace App\Livewire\Admin\Settings;

use App\Models\HeaderAffiliate;
use App\Models\HeaderCity;
use App\Models\Setting;
use App\Services\Admin\FooterHeaderService;
use App\Services\Admin\HeaderService;
use App\Services\Admin\ImageService;
use App\Services\Admin\Laboratory\BlockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditLeadForm extends Component
{
    use WithFileUploads;

    public string $email;


    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->email = Setting::firstOrCreate([
                'key' => 'lead_email',
            ])->value ?? '';
    }

    public function rules()
    {
        return [
            'email' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        Setting::where('key', 'lead_email')
            ->first()
            ->update([
                'value' => $this->email
            ]);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.lead-settings.index');
    }

    public function render()
    {
        return view('livewire.admin.settings.edit-lead-form');
    }
}
