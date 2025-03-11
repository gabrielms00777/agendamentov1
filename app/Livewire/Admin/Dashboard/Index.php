<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    public $totalAppointments;
    public $totalRevenue;
    public $popularServices;
    public $appointmentsToday;

    public function mount()
    {
        $this->totalAppointments = Appointment::whereDate('date_time', today())->count();
        $this->totalRevenue = Payment::whereDate('created_at', today())->where('status', 'paid')->sum('amount');
        $this->popularServices = Service::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(3)
            ->get();
        $this->appointmentsToday = Appointment::with(['client', 'service', 'professional'])
            ->whereDate('date_time', today())
            ->orderBy('date_time')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}
