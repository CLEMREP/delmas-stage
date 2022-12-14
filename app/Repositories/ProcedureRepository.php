<?php

namespace App\Repositories;

use App\Models\Procedure;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcedureRepository
{
    public function __construct(private Procedure $model)
    {
    }

    /**
     * @param  array<string>  $data
     */
    public function createProcedure(array $data): Procedure
    {
        return $this->model->create([
            'company_id' => $data['company_id'],
            'contact_id' => $data['contact_id'],
            'format_id' => $data['format_id'],
            'status_id' => $data['status_id'],
            'date' => $data['date'],
            'resend' => $data['resend'],
            'date_resend' => $data['date_resend'],
            'user_id' => $data['user_id'],
            'promotion_id' => $data['promotion_id'],
        ]);
    }

    /**
     * @param  array<string>  $data
     */
    public function updateProcedure(Procedure $procedure, array $data): bool|null
    {
        return $procedure->update([
            'company_id' => $data['company_id'],
            'contact_id' => $data['contact_id'],
            'format_id' => $data['format_id'],
            'status_id' => $data['status_id'],
            'date' => $data['date'],
            'resend' => $data['resend'],
            'date_resend' => $data['date_resend'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function deleteProcedure(Procedure $procedure): bool|null
    {
        return $procedure->delete();
    }

    public function getProceduresOfStudent(User $student): Collection
    {
        /** @var Collection $procedures */
        $procedures = $student->procedures;

        return $procedures;
    }

    public function getProceduresOfStudentPaginated(User $student): LengthAwarePaginator
    {
        return $student->procedures()->with(['status', 'format', 'contact', 'company'])->paginate(12);
    }

    public function allPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(10);
    }

    public function getAllProceduresOfPromotionsPaginated(Collection $promotions, int $perPage): LengthAwarePaginator
    {
        $procedures = $this->getAllProceduresOfPromotions($promotions);
        /** @var int $currentPage */
        $currentPage = request('page') ?? 1;

        return new LengthAwarePaginator(
            $procedures->forPage($currentPage, $perPage),
            $procedures->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function getAllProceduresOfPromotions(Collection $promotions): \Illuminate\Support\Collection
    {
        $procedures = new Collection();

        foreach ($promotions as $promotion) {
            /* @phpstan-ignore-next-line */
            foreach ($promotion->students as $student) {
                foreach ($student->procedures as $procedure) {
                    $procedures->add($procedure);
                }
            }
        }

        return $procedures;
    }

    public function getAllProceduresOfPromotionsWithStatus(Collection $promotions, int $statusId): \Illuminate\Support\Collection
    {
        return $this->getAllProceduresOfPromotions($promotions)->where('status_id', $statusId);
    }

    public function countAllProcedures(): int
    {
        return $this->model->newQuery()->count();
    }

    public function getProceduresOfPromotion(Promotion $promotion): Collection
    {
        return $this->model->newQuery()->where('promotion_id', $promotion->getKey())->get();
    }

    public function getProceduresOfPromotionPaginated(Promotion $promotion): LengthAwarePaginator
    {
        return $this->model->newQuery()->where('promotion_id', $promotion->getKey())->paginate(5);
    }

    public function countProceduresOfPromotionWithStatus(Promotion $promotion, int $status): int
    {
        return $this->getProceduresOfPromotion($promotion)->where('status_id', $status)->count();
    }

    public function countProceduresOfStudentWithStatus(User $student, int $status): int
    {
        return $student->procedures()->where('status_id', $status)->count();
    }

    public function countAllProceduresWithStatus(int $status): int
    {
        return $this->model->newQuery()->where('status_id', $status)->count();
    }

    public function countProceduresInSeries(User $admin): int
    {
        return $this->model->newQuery()
            ->with('student')
            ->whereHas('student', fn ($q) => $q->whereHas('promotion', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id'))))
            ->count();
    }

    public function getProceduresInSeriesPaginated(User $admin, int $perPage): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with('student')
            ->whereHas('student', fn ($q) => $q->whereHas('promotion', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id'))))
            ->paginate($perPage);
    }
}
