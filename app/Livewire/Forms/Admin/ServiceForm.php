<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Service;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    public ?Service $service;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:10')]
    public $description = '';

    #[Validate('required|numeric')]
    public $duration = '';

    #[Validate('required|numeric')]
    public $price = '';

    public function setService(Service $service)
    {
        $this->service = $service;

        $this->name = $service->name;
        $this->description = $service->description;
        $this->duration = $service->duration;
        $this->price = $service->price;
    }

    public function store()
    {
        $this->validate();

        Service::create($this->only(['name', 'description', 'duration', 'price']));

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->service->update(
            $this->only(['name', 'description', 'duration', 'price'])
        );
    }
}
