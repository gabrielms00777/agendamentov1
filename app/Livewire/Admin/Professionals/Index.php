<?php

namespace App\Livewire\Admin\Professionals;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Professional;
use App\Models\User;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $showFilters = false;
    public $filters = [
        'name' => null,
        'email' => null,
    ];

    public function render()
    {
        // Consulta base
        $query = Professional::with('user');

        // Aplicar filtros
        if ($this->filters['name']) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->filters['name'] . '%');
            });
        }
        if ($this->filters['email']) {
            $query->whereHas('user', function ($q) {
                $q->where('email', 'like', '%' . $this->filters['email'] . '%');
            });
        }

        // Paginação
        $professionals = $query->paginate(10);

        return view('livewire.admin.professionals.index', compact('professionals'));
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
