<?php

namespace App\Livewire\Admin\Robots;

use App\Models\Faq;
use App\Models\FaqTranslation;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Edit extends Component
{
    public string $content = '';

    public function mount()
    {
        $this->content = File::get(public_path('robots.txt'));
    }

    protected function rules()
    {
        return [
            'content' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected array $validationAttributes = [
        'content' => 'текст',
    ];

    public function save()
    {
        $this->validate();

        File::put(public_path('robots.txt'), $this->content);

        session()->flash('success', 'Дані успішно збережено');

        $this->redirectRoute('admin.edit-robots');
    }

    public function render()
    {
        return view('livewire.admin.robots.edit');
    }
}
