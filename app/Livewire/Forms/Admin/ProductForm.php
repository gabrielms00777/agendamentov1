<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Product;

class ProductForm extends Form
{
    public ?Product $product;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:10')]
    public $description = '';

    #[Validate('required|numeric')]
    public $price = '';

    public function setProduct(Product $product)
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
    }

    public function store()
    {
        $this->validate();

        Product::create($this->only(['name', 'description', 'price']));
    }

    public function update()
    {
        $this->validate();

        $this->product->update(
            $this->only(['name', 'description', 'price'])
        );
    }
}
