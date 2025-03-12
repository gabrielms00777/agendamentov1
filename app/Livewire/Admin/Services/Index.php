<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

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

    #[On('service-created')]
    #[Computed()]
    public function services()
    {
        return Service::query()
                ->when($this->filters['name'], fn ($query, $name) => $query->where('name', 'like', '%' . $name . '%'))
                ->when($this->filters['price_min'], fn ($query, $price) => $query->where('price', '>=', $price))
                ->when($this->filters['price_max'], fn ($query, $price) => $query->where('price', '<=', $price))
                ->latest()
                ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.services.index');
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
