<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Appointment;

class AppointmentForm extends Form
{
    public ?Appointment $appointment;

    #[Validate('required|exists:clients,id')]
    public $client_id = '';

    #[Validate('required|exists:professionals,id')]
    public $professional_id = '';

    #[Validate('required|exists:services,id')]
    public $service_id = '';

    #[Validate('required|date')]
    public $date_time = '';

    #[Validate('required|string')]
    public $status = '';

    #[Validate('nullable|string')]
    public $notes = '';

    public function setAppointment(Appointment $appointment)
    {
        $this->appointment = $appointment;

        $this->client_id = $appointment->client_id;
        $this->professional_id = $appointment->professional_id;
        $this->service_id = $appointment->service_id;
        $this->date_time = $appointment->date_time;
        $this->status = $appointment->status;
        $this->notes = $appointment->notes;
    }

    public function store()
    {
        $this->validate();

        Appointment::create($this->only([
            'client_id',
            'professional_id',
            'service_id',
            'date_time',
            'status',
            'notes',
        ]));
    }

    public function update()
    {
        $this->validate();

        $this->appointment->update(
            $this->only([
                'client_id',
                'professional_id',
                'service_id',
                'date_time',
                'status',
                'notes',
            ])
        );
    }
}
