<?php

namespace App\Http\Controllers\Student\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
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
        $user = loggedUser();

        $companies = $this->companyRepository->getCompaniesOfStudentPaginated($user);

        return view('delmas.student.companies.index', [
            'title' => 'Mes entreprises',
            'companies' => $companies,
        ]);
    }

    public function create(): View
    {
        $user = loggedUser();

        $contacts = $this->contactRepository->getContactsFromStudent($user);

        return view('delmas.student.companies.create', [
            'title' => 'Création d\'une entreprise',
            'contacts' => $contacts,
        ]);
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        /** @var int $contactId */
        $contactId = $validated['contact_id'];

        abort_if($this->studentRepository->checkStudentHasThisContact($user, $contactId), 403);

        $this->companyRepository->createCompany($validated, $user);

        return redirect(route('student.companies.index'))->with('success', 'Votre entreprise a bien été créée !');
    }

    public function show(Company $company): View
    {
        $user = loggedUser();

        $contact = $this->companyRepository->getContactOfCompany($company);

        abort_if($this->companyRepository->companyBelongsToStudent($user, $company), 403);

        return view('delmas.student.companies.show', [
            'title' => 'Fiche entreprise de '.$company->name,
            'company' => $company,
            'contact' => $contact,
        ]);
    }

    public function edit(Company $company): View
    {
        $user = loggedUser();

        abort_if($this->companyRepository->companyBelongsToStudent($user, $company), 403);

        $contacts = $this->contactRepository->getContactsFromStudent($user);

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

        $user = loggedUser();

        /** @var int $contactId */
        $contactId = $validated['contact_id'];

        abort_if($this->companyRepository->companyBelongsToStudent($user, $company), 403);

        abort_if($this->studentRepository->checkStudentHasThisContact($user, $contactId), 403);

        $this->companyRepository->updateCompany($validated, $company, $user);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été modifiée !');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $user = loggedUser();

        abort_if($this->companyRepository->companyBelongsToStudent($user, $company), 403);

        $this->companyRepository->deleteCompany($company);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été supprimée !');
    }
}
