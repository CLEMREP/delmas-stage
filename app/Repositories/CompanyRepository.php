<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CompanyRepository
{
    public function __construct(private Company $model)
    {
    }

    /**
     * @param  array<string>  $data
     */
    public function createCompany(array $data, User $student): Company
    {
        return $this->model->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'user_id' => $student->getKey(),
            'promotion_id' => $student->promotion->getKey(),
        ]);
    }

    /**
     * @param  array<string>  $data
     */
    public function updateCompany(array $data, Company $company, User $student): bool|null
    {
        return $company->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'user_id' => $student->getKey(),
            'promotion_id' => $student->promotion->getKey(),
        ]);
    }

    public function getCompaniesOfStudent(User $student): Collection
    {
        return $student->companies()->get();
    }

    public function getCompaniesOfPromotion(int $promotionId): Collection
    {
        return $this->model->whereHas('student', function ($query) use ($promotionId) {
            $query->where('promotion_id', $promotionId);
        })->get();
    }

    public function getCompaniesOfStudentPaginated(User $student): LengthAwarePaginator
    {
        return $student->companies()->paginate(5);
    }

    public function getAllCompanies(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    public function companyBelongsToStudent(User $student, Company $company): bool
    {
        return $student->companies() /** @phpstan-ignore-line */
            ->where('id', $company->getKey())
            ->get()
            ->isEmpty();
    }

    public function deleteCompany(Company $company): bool|null
    {
        return $company->delete();
    }

    public function countCompaniesInSeries(User $admin): int
    {
        $seriesIds = $admin->series->pluck('id');
        $seriesIdsJson = [];

        foreach ($seriesIds as $id)
        {
            $seriesIdsJson['ids'][] = ['id' => $id];
        }

        $result = DB::select("CALL count_hire_companies(?, ?)", [
            json_encode($seriesIdsJson),
            '3',
        ]);

        return $result[0]->{'count(*)'};
    }

    public function checkCompanyIsInThisPromotion(User $student, int|null $companyPromotionId): bool
    {
        if ($companyPromotionId == $student->promotion->getKey()) {
            return false;
        }

        return true;
    }

    public function checkCompanyHasThisContact(int $companyId, int $contactId): bool
    {
        if (Contact::find($contactId)->company->getKey() == $companyId) {
            return false;
        }

        return true;
    }

    public function findCompanyById(int $id): Company|null
    {
        return $this->model->find($id);
    }

    public function checkAdminHasThisCompany(User $admin, Company $company): bool
    {
        $request = $this->model->newQuery()
            ->with(['student'])
            ->whereHas('student', fn ($q) => $q->whereHas('promotion', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id'))))
            ->where('id', $company->getKey())
            ->get();

        return $request->isEmpty();
    }
}
