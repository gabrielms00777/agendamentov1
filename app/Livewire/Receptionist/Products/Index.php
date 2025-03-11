<?php

namespace App\Livewire\Receptionist\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.receptionist')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.receptionist.products.index');
    }
}
