<?php

namespace App\Livewire\Receptionist\Clients;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.receptionist')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.receptionist.clients.index');
    }
}
