<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->endOfMonth()->toDateString();
    }

    public function render()
    {
        // Relatório de Agendamentos
        $appointments = Appointment::whereBetween('date_time', [$this->startDate, $this->endDate])
            ->get();

        // Relatório de Faturamento
        $revenue = Payment::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->where('status', 'paid')
            ->sum('amount');

        // Relatório de Produtos Vendidos
        $productsSold = Product::withCount(['sales' => function ($query) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }])
            ->orderBy('sales_count', 'desc')
            ->get();

        return view('livewire.admin.reports.index', compact('appointments', 'revenue', 'productsSold'));
    }
}
