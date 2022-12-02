<?php

namespace App\Repositories;

use App\Models\Enums\Roles;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public function __construct(private User $model)
    {
    }

    public function allAdminsPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->admin()->paginate(12);
    }

    public function countAdmins(): int
    {
        return $this->model->newQuery()->admin()->count();
    }

    /**
     * @param  array<string>  $data
     * @return User
     */
    public function createAdmin(array $data): User
    {
        $admin = $this->model->create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'role' => Roles::Admin,
            'password' => Hash::make('password'),
        ]);

        $admin->series()->attach($data['serie_id']);

        return $admin;
    }

    /**
     * @param  array<string>  $data
     * @param  User  $admin
     * @return bool|null
     */
    public function updateAccount(array $data, User $admin): bool|null
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

        $admin->series()->detach();
        $admin->series()->attach($data['serie_id']);

        return $admin->update($attributes);
    }

    public function delete(User $admin): bool|null
    {
        return $admin->delete();
    }

    public function countUsersInAdminSeries(User $admin): int
    {
        return $this->model
            ->newQuery()
            ->with('promotion')
            ->whereHas('promotion', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
            ->count();
    }

    public function checkAdminHasThisSerie(User $teacher, int $serieId): bool
    {
        $request = $teacher->series()
            ->where('id', $serieId)
            ->get();

        return $request->isEmpty();
    }

    public function checkAdminHasThisTeacher(User $admin, User $teacher): bool
    {
        $request = $this->model::teacher()->with('promotions')
            ->whereHas('promotions', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
            ->where('id', $teacher->getKey())
            ->get();

        return $request->isEmpty();
    }
}
