<?php

namespace App\Http\Controllers\Student\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Student;
use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private ContactRepository $contactRepository,
        private StudentRepository $studentRepository,
    ) {
    }

    public function index(): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $companies = $this->companyRepository->getCompaniesOfStudentPaginated($student);

        return view('delmas.student.companies.index', [
            'title' => 'Mes entreprises',
            'companies' => $companies,
        ]);
    }

    public function create(): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $contacts = $this->contactRepository->getContactsFromStudent($student);

        return view('delmas.student.companies.create', [
            'title' => 'Création d\'une entreprise',
            'contacts' => $contacts,
        ]);
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $validated['contact_id'];

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        $this->companyRepository->createCompany($validated, $student);

        return redirect(route('student.companies.index'))->with('success', 'Votre entreprise a bien été créée !');
    }

    public function show(Company $company): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $contact = $this->companyRepository->getContactOfCompany($company);

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 404);

        return view('delmas.student.companies.show', [
            'title' => 'Fiche entreprise de '.$company->name,
            'company' => $company,
            'contact' => $contact,
        ]);
    }

    public function edit(Company $company): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 404);

        $contacts = $this->contactRepository->getContactsFromStudent($student);

        return view('delmas.student.companies.edit', [
            'title' => 'Édition de '.$company->name,
            'company' => $company,
            'contacts' => $contacts,
        ]);
    }

    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $validated['contact_id'];

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 404);

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        $this->companyRepository->updateCompany($validated, $company, $student);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été modifiée !');
    }

    public function destroy(Company $company): RedirectResponse
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 404);

        $this->companyRepository->deleteCompany($company);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été supprimée !');
    }
}
