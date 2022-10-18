<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\Student;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ContactRepository
{
    public function __construct(private Contact $model)
    {
    }

    public function createContact(array $data): Contact
    {
        return $this->model->create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'job_id' => $data['job_id'],
            'student_id' => $data['student_id'],
            ]);
    }

    public function updateContact(array $data, Contact $contact): bool
    {
        return $contact->update([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'job_id' => $data['job_id'],
            'student_id' => $data['student_id'],
        ]);
    }

    public function getContactsFromStudent(Student $student): Collection
    {
        return $student->contacts()->get();
    }

    public function getContactsOfStudentPaginated(Student $student): LengthAwarePaginator
    {
        return $student->contacts()->paginate(5);
    }

    public function deleteContact(Contact $contact): bool
    {
        return $contact->delete();
    }
}
