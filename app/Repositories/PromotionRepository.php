<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PromotionRepository
{
    public function __construct(private Promotion $model)
    {
    }

    public function getPromotionsInSeries(User $admin): Collection
    {
        return $this->model->newQuery()
            ->whereIn('serie_id', $admin->series->pluck('id'))
            ->get();
    }

    public function getPromotionsInSeriesPaginated(User $admin): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->whereIn('serie_id', $admin->series->pluck('id'))
            ->paginate(10);
    }

    public function getAllPromotions(): Collection
    {
        return $this->model->all();
    }

    public function getAllPromotionsPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    public function createPromotion(array $data): Promotion
    {
        return $this->model->create([
            'name' => $data['name'],
            'serie_id' => $data['serie_id'],
        ]);
    }

    public function updatePromotion(array $data, Promotion $promotion): bool
    {
        return $promotion->update([
            'name' => $data['name'],
            'serie_id' => $data['serie_id'],
        ]);
    }

    public function deletePromotion(Promotion $promotion): bool|null
    {
        return $promotion->delete();
    }

    public function findPromotionById(array $data): Promotion|null
    {
        return $this->model->all()
            ->where('id', $data['promotion_id'])
            ->first();
    }
}
