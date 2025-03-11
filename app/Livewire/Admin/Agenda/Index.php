<?php

namespace App\Livewire\Admin\Agenda;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = Appointment::with(['client', 'service', 'professional'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'title' => $appointment->client->name . ' - ' . $appointment->service->name,
                    'start' => $appointment->date_time->toIso8601String(),
                    'end' => $appointment->date_time->addMinutes($appointment->service->duration)->toIso8601String(),
                    'color' => $this->getEventColor($appointment->status),
                ];
            })
            ->toArray();
    }

    protected function getEventColor($status)
    {
        return match ($status) {
            'pending' => '#fbbf24', // Amarelo
            'confirmed' => '#34d399', // Verde
            'canceled' => '#ef4444', // Vermelho
            default => '#3b82f6', // Azul
        };
    }

    public function render()
    {
        return view('livewire.admin.agenda.index');
    }
}
