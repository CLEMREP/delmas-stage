<?php

namespace App\Repositories;

use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\UserResource;
use App\Models\Enums\Roles;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class TeacherRepository
{
    public function __construct(private User $model)
    {
    }

    public function allStudents(User $teacher): Collection
    {
        $promotions = $teacher->promotions;
        $students = new Collection();

        foreach ($promotions as $promotion) {
            foreach ($promotion->students as $student) {
                $students->add($student);
            }
        }

        return $students;
    }



    public function create(array $data): User
    {

        $teacher = $this->model->create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make('password'),
            'role' => Roles::Teacher,
        ]);

        $teacher->promotions()->attach($data['promotion_id']);

        return $teacher;
    }

    /**
     * @param  array<string>  $data
     */
    public function updateAccount(array $data, User $teacher): bool
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

        return $teacher->update($attributes);
    }

    public function delete(User $teacher): bool|null
    {
        return $teacher->delete();
    }

    public function checkTeacherHasThisPromotion(User $teacher, int $promotionId): bool
    {
        return $teacher->promotions() /** @phpstan-ignore-line */
        ->where('id', $promotionId)
            ->get()
            ->isEmpty();
    }

    public function checkTeacherHasThisStudent(User $student): bool
    {
        $teacher = loggedUser();

        return $teacher->promotions()
        ->whereHas('students', fn($q) => $q->where('id', $student->getKey()))
            ->get()
            ->isEmpty();
    }
}
