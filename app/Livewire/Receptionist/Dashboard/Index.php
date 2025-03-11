<?php

namespace App\Livewire\Receptionist\Dashboard;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Livewire\Component;
use App\Models\Appointment;
use Livewire\Attributes\Layout;

#[Layout('layouts.receptionist')]
class Index extends Component
{
    public $totalAppointments;
    public $totalClients;
    public $appointmentsToday;

    public function mount()
    {
        $this->totalAppointments = Appointment::whereDate('date_time', today())->count();
        $this->totalClients = User::query()->where('role', UserRoleEnum::CLIENT)->count();
        $this->appointmentsToday = Appointment::with(['client', 'service', 'professional'])
            ->whereDate('date_time', today())
            ->orderBy('date_time')
            ->get();
    }

    public function render()
    {
        return view('livewire.receptionist.dashboard.index');
    }
}
