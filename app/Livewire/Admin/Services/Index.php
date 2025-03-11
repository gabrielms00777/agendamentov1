<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

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

    public function render()
    {
        // Consulta base
        $query = Service::query();

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
        $services = $query->paginate(10);

        return view('livewire.admin.services.index', compact('services'));
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
