<?php

namespace App\Repositories;

use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\UserResource;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TeacherRepository
{
    public function __construct(private Teacher $model)
    {
    }

    public function allStudents(Teacher $teacher)
    {
        $promotions = $teacher->promotions;
        $students = new Collection();

        foreach ($promotions as $promotion) {
            foreach ($promotion->students as $student) {
                $students->add($student->user);
            }
        }

        return $students;
    }

    public function allStudentsPaginated(Teacher $teacher)
    {
        $students = $this->allStudents($teacher);

        $perPage = 10;
        $currentPage = request("page") ?? 1;

        return new LengthAwarePaginator(
            $students->forPage($currentPage, $perPage),
            $students->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    /**
     * @param  array<string>  $data
     */
    public function updateAccount(array $data, Teacher $teacher): bool
    {
        $attributes = [
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
        ];

        $teacherAttributes = [
            'phone' => $data['phone'] ?? '',
        ];

        if (!empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        $teacher->user()->update($attributes);

        return $teacher->update($teacherAttributes);
    }

    public function checkTeacherHasThisPromotion(Teacher $teacher, int $promotionId): bool
    {
        return $teacher->promotions() /** @phpstan-ignore-line */
        ->where('id', $promotionId)
            ->get()
            ->isEmpty();
    }
}
