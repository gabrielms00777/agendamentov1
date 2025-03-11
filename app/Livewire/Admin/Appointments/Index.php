<?php

namespace App\Livewire\Admin\Appointments;

use App\Enums\AppointmentStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Appointment;
use App\Models\Professional;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $filters = [
        'date' => null,
        'status' => null,
        'client_id' => null,
        'professional_id' => null,
    ];

    public function render()
    {
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

        return view('livewire.admin.appointments.index', compact('appointments', 'clients', 'professionals', 'statuses'));
    }

    public function updateStatus($appointmentId, $status)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => $status]);
        session()->flash('message', 'Status do agendamento atualizado com sucesso!');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
