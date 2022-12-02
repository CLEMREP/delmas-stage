<?php

namespace App\Models\Enums;

enum Roles: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';
}
