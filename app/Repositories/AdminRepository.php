<?php

namespace App\Repositories;

use App\Models\Format;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public function __construct(private User $model)
    {
    }

    public function updateAccount(array $data, User $admin): bool|null
    {
        $attributes = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
        ];

        if (!empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        return $admin->update($attributes);
    }

    public function countUsersInAdminSeries(User $admin): int
    {
        return $this->model
            ->newQuery()
            ->with('promotion')
            ->whereHas('promotion', fn($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
            ->get()
            ->count();
    }

    public function checkAdminHasThisSerie(User $teacher, int $serieId): bool
    {
        return $teacher->series() /** @phpstan-ignore-line */
        ->where('id', $serieId)
            ->get()
            ->isEmpty();
    }

    public function checkAdminHasThisTeacher(User $admin, User $teacher): bool
    {
        return $this->model::teacher()->with('promotions')
            ->whereHas('promotions', fn($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
            ->where('id', $teacher->getKey())
            ->get()
            ->isEmpty();
    }
}
