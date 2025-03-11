<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $showFilters = false;
    public $filters = [
        'name' => null,
        'price_min' => null,
        'price_max' => null,
    ];

    public $showModal = false;
    public $modalType = 'create'; // 'create' ou 'edit'
    public $productId = null;
    public $name = '';
    public $description = '';
    public $price = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ];

    public function render()
    {
        // Consulta base
        $query = Product::query();

        // Aplicar filtros
        if ($this->filters['name']) {
            $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        }
        if ($this->filters['price_min']) {
            $query->where('price', '>=', $this->filters['price_min']);
        }
        if ($this->filters['price_max']) {
            $query->where('price', '<=', $this->filters['price_max']);
        }

        // Paginação
        $products = $query->paginate(10);

        return view('livewire.admin.products.index', compact('products'));
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function openModal($type, $productId = null)
    {
        $this->modalType = $type;
        $this->productId = $productId;

        if ($type === 'edit') {
            $product = Product::findOrFail($productId);
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'modalType', 'productId', 'name', 'description', 'price']);
    }

    public function saveProduct()
    {
        $this->validate();

        if ($this->modalType === 'create') {
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]);
            session()->flash('message', 'Produto cadastrado com sucesso!');
        } else {
            $product = Product::findOrFail($this->productId);
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]);
            session()->flash('message', 'Produto atualizado com sucesso!');
        }

        $this->closeModal();
    }

    public function deleteProduct($productId)
    {
        Product::findOrFail($productId)->delete();
        session()->flash('message', 'Produto excluído com sucesso!');
    }
}
