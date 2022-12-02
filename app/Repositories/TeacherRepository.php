<?php

namespace App\Repositories;

use App\Models\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class TeacherRepository
{
    public function __construct(private User $model)
    {
    }

    public function countTeachers(): int
    {
        return $this->model->newQuery()->where('role', Roles::Teacher->value)->count();
    }

    public function allStudents(User $teacher): Collection
    {
        $promotions = $teacher->promotions;

        $students = new Collection();

        foreach ($promotions as $promotion) {
            /* @phpstan-ignore-next-line */
            foreach ($promotion->students as $student) {
                $students->add($student);
            }
        }

        return $students;
    }

    /**
     * @param  array<string>  $data
     * @return User
     */
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

        if (! empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        $teacher->promotions()->detach();
        $teacher->promotions()->attach($data['promotion_id']);

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

        $student = $teacher->promotions()
            ->whereHas('students', fn ($q) => $q->where('id', $student->getKey()))
            ->get();

        return $student->isEmpty();
    }
}
