<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
    public function __construct(private Student $model)
    {
    }

    public function getAllStudents(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array<string>  $data
     */
    public function updateAccount(array $data, Student $student): bool
    {
        $attributes = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
        ];

        $studentAttributes = [
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

        $student->user()->update($attributes);

        return $student->update($studentAttributes);
    }

    public function checkStudentHasThisContact(Student $student, int $contactId): bool
    {
        return $student->contacts() /** @phpstan-ignore-line */
            ->where('id', $contactId)
            ->get()
            ->isEmpty();
    }

    public function checkStudentHasThisProcedure(Student $student, int $procedureId): bool
    {
        return $student->procedures() /** @phpstan-ignore-line */
            ->where('id', $procedureId)
            ->get()
            ->isEmpty();
    }

    public function checkStudentHasThisCompany(Student $student, int $companyId): bool
    {
        return $student->companies() /** @phpstan-ignore-line */
            ->where('id', $companyId)
            ->get()
            ->isEmpty();
    }
}
