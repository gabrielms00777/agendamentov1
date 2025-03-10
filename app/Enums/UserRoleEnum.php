<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case RECEPTIONIST = 'receptionist';
    case PROFESSIONAL = 'professional';
    case CLIENT = 'client';
}
