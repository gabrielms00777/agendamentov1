<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\Admin\ProductForm;
use Livewire\Component;

class Create extends Component
{
    public ProductForm $form;
    
    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }
}
