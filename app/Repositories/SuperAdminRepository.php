<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminRepository
{
    public function __construct(private User $model)
    {
    }

    /**
     * @param  array<string>  $data
     * @param  User  $superadmin
     * @return bool|null
     */
    public function updateAccount(array $data, User $superadmin): bool|null
    {
        $attributes = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
        ];

        if (! empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        return $superadmin->update($attributes);
    }

    public function countUsers(): int
    {
        return $this->model->newQuery()->count();
    }
}
