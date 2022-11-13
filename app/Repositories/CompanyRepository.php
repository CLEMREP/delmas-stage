<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            'contact_id' => $data['contact_id'],
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
            'contact_id' => $data['contact_id'],
        ]);
    }

    public function getContactOfCompany(Company $company): Contact
    {
        /** @var Contact $contact */
        $contact = $company->contact()->first();

        return $contact;
    }

    public function getCompaniesOfStudent(User $student): Collection
    {
        return $student->companies()->get();
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
        return $this->model->newQuery()
            ->with(['student', 'procedure'])
            ->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->whereIn('serie_id', $admin->series->pluck('id'))))
            ->whereHas('procedures', fn($q) => $q->where('status_id', 3))
            ->count();
    }

    public function checkAdminHasThisCompany(User $admin, Company $company): bool
    {
        return $this->model->newQuery()
            ->with(['student'])
            ->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->whereIn('serie_id', $admin->series->pluck('id'))))
            ->where('id', $company->getKey())
            ->get()
            ->isEmpty();
    }
}
