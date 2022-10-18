<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Student;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository
{
    public function __construct(private Company $model)
    {
    }

    public function createCompany(array $data, Student $student): Company
    {
        return $this->model->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'student_id' => $student->getKey(),
            'contact_id' => $data['contact_id'],
        ]);
    }

    public function updateCompany(array $data, Company $company, Student $student): bool|null
    {
        return $company->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'student_id' => $student->getKey(),
            'contact_id' => $data['contact_id'],
        ]);
    }

    public function getContactOfCompany(Company $company): Contact
    {
        /** @var Contact $contact */
        $contact = $company->contact()->first();

        return $contact;
    }

    public function getCompaniesOfStudent(Student $student): LengthAwarePaginator
    {
        return $student->companies()->paginate(5);
    }

    public function getAllCompanies(): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate(5);
    }

    public function companyBelongsToStudent(Student $student, Company $company): bool
    {
        return $student->companies()
            ->where('id', $company->getKey())
            ->get()
            ->isEmpty();
    }

    public function deleteCompany(Company $company): bool|null
    {
        return $company->delete();
    }
}