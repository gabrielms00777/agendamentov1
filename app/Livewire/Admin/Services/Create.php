<?php

namespace App\Livewire\Admin\Services;

use App\Livewire\Forms\Admin\ServiceForm;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Create extends Component
{
    public ServiceForm $form;

    public function save()
    {
        $this->form->store();

        $this->dispatch('service-created');

        $this->js("document.getElementById('close-modal').click()");
    }

    public function render()
    {
        return view('livewire.admin.services.create');
    }
}
