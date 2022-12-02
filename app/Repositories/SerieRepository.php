<?php

namespace App\Repositories;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SerieRepository
{
    public function __construct(private Serie $model)
    {
    }

    public function allSeries(): Collection
    {
        return $this->model->all();
    }

    public function allSeriesPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(12);
    }

    /**
     * @param  array<string>  $data
     * @return Serie
     */
    public function createSerie(array $data): Serie
    {
        return $this->model->create([
            'name' => $data['name'],
        ]);
    }

    /**
     * @param  array<string>  $data
     * @param  Serie  $serie
     * @return bool
     */
    public function updateSerie(array $data, Serie $serie): bool
    {
        return $serie->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteSerie(Serie $serie): bool|null
    {
        return $serie->delete();
    }

    public function countSeries(): int
    {
        return $this->model->newQuery()->count();
    }

    public function countPromotionsInSeries(User $admin): mixed
    {
        return $this->model->newQuery()
            ->withCount('promotions')
            ->whereIn('id', $admin->series->pluck('id'))
            ->get()
            ->sum('promotions_count');
    }

    public function checkSeriesHasThisPromotion(User $admin, string $promotionId): bool
    {
        $request = $this->model->newQuery()
            ->whereHas('promotions', fn ($q) => $q->where('id', $promotionId))
            ->whereIn('id', $admin->series->pluck('id'))
            ->get();

        return $request->isEmpty();
    }

    /**
     * @param  User  $admin
     * @param  array<string>  $promotions
     * @return bool
     */
    public function checkSeriesHasThesePromotions(User $admin, array $promotions): bool
    {
        $request = $this->model->newQuery()
            ->whereHas('promotions', fn ($q) => $q->whereIn('id', $promotions))
            ->whereIn('id', $admin->series->pluck('id'))
            ->get();

        return $request->isEmpty();
    }

    public function checkIfSerieExist(int $serieId): bool
    {
        /* @phpstan-ignore-next-line */
        return $this->model->newQuery()->findOrFail($serieId)->isEmpty();
    }
}
