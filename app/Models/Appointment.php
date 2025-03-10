<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'professional_id',
        'service_id',
        'date_time',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => AppointmentStatusEnum::class,
        ];
    }
}
