<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPoint extends Model
{
    /** @use HasFactory<\Database\Factories\LoyaltyPointFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
    ];
}
