<?php

namespace App\Repositories;

use App\Models\Goal;
use App\Models\Promotion;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GoalRepository
{
    public function __construct(private Goal $model)
    {
    }

    public function allPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    public function getGoalsByPromotion(Promotion $promotion): Collection
    {
        return $promotion->goals;
    }

    public function getGoalsByPromotionPaginated(Promotion $promotion): LengthAwarePaginator
    {
        return $promotion->goals()->paginate(5);
    }

    public function getGoalsByPromotions(Collection $promotions): Collection
    {
        $goals = new Collection();

        foreach ($promotions as $promotion)
        {
            foreach ($promotion->goals as $goal)
            {
                $goals->add($goal);
            }
        }

        return $goals;
    }

    public function getGoalsByPromotionsPaginated(Collection $promotions): LengthAwarePaginator
    {
        $goals = $this->getGoalsByPromotions($promotions);
        $currentPage = request("page") ?? 1;
        $perPage = 10;

        return new LengthAwarePaginator(
            $goals->forPage($currentPage, $perPage),
            $goals->count(),
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
    public function createGoal(array $data): Goal
    {
        return $this->model->create([
            'content' => $data['content'],
            'created_at' => Carbon::now()->format('d-m-Y'),
            'promotion_id' => $data['promotion_id'],
        ]);
    }

    /**
     * @param  array<string>  $data
     */
    public function updateGoal(array $data, Goal $goal): bool|null
    {
        return $goal->update([
            'content' => $data['content'],
            'promotion_id' => $data['promotion_id'],
        ]);
    }

    public function deleteGoal(Goal $goal): bool|null
    {
        return $goal->delete();
    }
}
