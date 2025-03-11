<?php

namespace App\Livewire\Admin\Clients;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Layout;

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
        $query = User::where('role', 'client');

        // Aplicar filtros
        if ($this->filters['name']) {
            $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        }
        if ($this->filters['email']) {
            $query->where('email', 'like', '%' . $this->filters['email'] . '%');
        }

        // Paginação
        $clients = $query->paginate(10);

        return view('livewire.admin.clients.index', compact('clients'));
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
