<?php

namespace App\Repositories;

use App\Models\Format;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SerieRepository
{
    public function __construct(private Serie $model)
    {
    }

    public function countPromotionsInSeries(User $admin): int
    {
        return $this->model->newQuery()
            ->withCount('promotions')
            ->whereIn('id', $admin->series->pluck('id'))
            ->get()
            ->sum('promotions_count');
    }

    public function checkSeriesHasThisPromotion(User $admin, int $promotionId): bool
    {
        return $this->model->newQuery()
            ->whereHas('promotions', fn($q) => $q->where('id', $promotionId))
            ->whereIn('id', $admin->series->pluck('id'))
            ->get()
            ->isEmpty();
    }
}
