<?php

namespace App\Livewire\Receptionist\Appointments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;
use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Professional;
use App\Enums\AppointmentStatusEnum;
use Livewire\Attributes\Layout;

#[Layout('layouts.receptionist')]
class Index extends Component
{
    use WithPagination;

    public $showFilters = false;
    public $filters = [
        'date' => null,
        'status' => null,
        'client_id' => null,
        'professional_id' => null,
    ];

    public function render()
    {
        // Consulta base
        $query = Appointment::with(['client', 'service', 'professional'])
            ->orderBy('date_time', 'desc');

        // Aplicar filtros
        if ($this->filters['date']) {
            $query->whereDate('date_time', $this->filters['date']);
        }
        if ($this->filters['status']) {
            $query->where('status', $this->filters['status']);
        }
        if ($this->filters['client_id']) {
            $query->where('client_id', $this->filters['client_id']);
        }
        if ($this->filters['professional_id']) {
            $query->where('professional_id', $this->filters['professional_id']);
        }

        // Paginação
        $appointments = $query->paginate(10);

        // Dados para os filtros
        $clients = User::query()->where('role', UserRoleEnum::CLIENT)->get();
        $professionals = Professional::all();
        $statuses = AppointmentStatusEnum::cases();

        return view('livewire.receptionist.appointments.index', compact('appointments', 'clients', 'professionals', 'statuses'));
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function updateStatus($appointmentId, $status)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => $status]);
        session()->flash('message', 'Status do agendamento atualizado com sucesso!');
    }
}
