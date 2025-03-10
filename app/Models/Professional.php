<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    /** @use HasFactory<\Database\Factories\ProfessionalFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'professional_service');
    }
}
