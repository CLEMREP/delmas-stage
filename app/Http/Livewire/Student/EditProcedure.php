<?php

namespace App\Http\Livewire\Student;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Procedure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class EditProcedure extends Component
{
    public Procedure $procedure;

    public int $companyId;

    public Collection $contacts;

    public function mount(): void
    {
        $this->companyId = $this->procedure->company_id;
        $this->getContacts();
    }

    public function updatedCompanyId(): void
    {
        $this->getContacts();
    }

    public function getContacts(): void
    {
        if ($this->companyId != '') {
            $this->contacts = Contact::where('company_id', $this->companyId)->get();
        }
    }

    public function render(): View
    {
        $student = loggedUser();

        return view('livewire.student.create-procedure', [
            'companies' => Company::whereHas('student', function ($query) use ($student) {
                $query->where('promotion_id', $student->promotion->getKey());
            })->get(),
        ]);
    }
}
