<?php

namespace App\Livewire\Admin\Services;

use App\Livewire\Forms\Admin\ServiceForm;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public ?ServiceForm $form;
    public bool $showModal = false;

    #[On('service-editModal')]
    public function openModal(Service $service)
    {
        $this->showModal = true;
        $this->form->setService($service);
    }


    public function render()
    {
        return view('livewire.admin.services.edit');
    }
}
