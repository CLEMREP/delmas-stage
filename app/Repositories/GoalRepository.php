<?php

namespace App\Repositories;

use App\Models\Goal;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class GoalRepository
{
    public function __construct(private Goal $model)
    {
    }

    public function getAllGoals(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    /**
     * @param  array<string>  $data
     */
    public function createGoal(array $data, Teacher $teacher): Goal
    {
        return $this->model->create([
            'content' => $data['content'],
            'created_at' => Carbon::now()->format('d-m-Y'),
            'teacher_id' => $teacher->getKey(),
        ]);
    }

    /**
     * @param  array<string>  $data
     */
    public function updateGoal(array $data, Goal $goal): bool|null
    {
        return $goal->update([
            'content' => $data['content'],
        ]);
    }

    public function deleteGoal(Goal $goal): bool|null
    {
        return $goal->delete();
    }
}
