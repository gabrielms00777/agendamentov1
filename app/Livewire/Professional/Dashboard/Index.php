<?php

namespace App\Livewire\Professional\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.professional')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.professional.dashboard.index');
    }
}
