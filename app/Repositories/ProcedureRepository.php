<?php

namespace App\Repositories;

use App\Models\Procedure;
use App\Models\Promotion;
use App\Models\Student;
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
            'format_id' => $data['format_id'],
            'status_id' => $data['status_id'],
            'date' => $data['date'],
            'resend' => $data['resend'],
            'date_resend' => $data['date_resend'],
            'student_id' => $data['student_id'],
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
            'format_id' => $data['format_id'],
            'status_id' => $data['status_id'],
            'date' => $data['date'],
            'resend' => $data['resend'],
            'date_resend' => $data['date_resend'],
            'student_id' => $data['student_id'],
        ]);
    }

    public function deleteProcedure(Procedure $procedure): bool|null
    {
        return $procedure->delete();
    }

    public function getProceduresOfStudent(Student $student): Collection
    {
        return $student->procedures;
    }

    public function getProceduresOfStudentPaginated(Student $student): LengthAwarePaginator
    {
        return $student->procedures()->paginate(5);
    }

    public function allPaginated(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    public function getAllProceduresOfPromotionsPaginated(Collection $promotions, int $perPage): LengthAwarePaginator
    {
        $procedures = $this->getAllProceduresOfPromotions($promotions);
        $currentPage = request("page") ?? 1;

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

        foreach ($promotions as $promotion)
        {
            foreach ($promotion->students as $student)
            {
                foreach ($student->procedures as $procedure)
                {
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

    public function countProceduresOfStudentWithStatus(Student $student, int $status): int
    {
        return $student->procedures()->where('status_id', $status)->count();
    }

    public function countAllProceduresWithStatus(int $status): int
    {
        return $this->model->newQuery()->where('status_id', $status)->count();
    }
}
