<?php

namespace App\Repositories;

use App\Models\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
    public function __construct(private User $model)
    {
    }

    public function getAllStudents(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): User
    {
        return $this->model->create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make('password'),
            'promotion_id' => $data['promotion_id'],
            'role' => Roles::Student,
        ]);
    }

    /**
     * @param  array<string>  $data
     */
    public function updateAccount(array $data, User $student): bool
    {
        $attributes = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'promotion_id' => $data['promotion_id'] ?? '',
            'zip' => $data['zip'] ?? '',
            'city' => $data['city'] ?? '',
            'address' => $data['address'] ?? '',
            'motivation' => $data['motivation'] ?? '',
            'desire' => $data['desire'] ?? '',
            'mobility' => $data['mobility'] ?? true,
        ];

        if (!empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        return $student->update($attributes);
    }

    public function delete(User $student): bool|null
    {
        return $student->delete();
    }

    public function checkStudentHasThisContact(User $student, int $contactId): bool
    {
        return $student->contacts() /** @phpstan-ignore-line */
            ->where('id', $contactId)
            ->get()
            ->isEmpty();
    }

    public function checkStudentHasThisProcedure(User $student, int $procedureId): bool
    {
        return $student->procedures() /** @phpstan-ignore-line */
            ->where('id', $procedureId)
            ->get()
            ->isEmpty();
    }

    public function checkStudentHasThisCompany(User $student, int $companyId): bool
    {
        return $student->companies() /** @phpstan-ignore-line */
            ->where('id', $companyId)
            ->get()
            ->isEmpty();
    }

    public function checkAdminHasThisStudent(User $admin, User $student): bool
    {
        return $this->model->newQuery()
            ->whereHas('promotion', fn($q) => $q->whereHas('serie', fn($q) => $q->whereIn('id', $admin->series->pluck('id'))))
            ->where('id', $student->getKey())
            ->get()
            ->isEmpty();
    }
}
