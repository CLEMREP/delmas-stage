<?php

namespace App\Http\Controllers\Student\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private ContactRepository $contactRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.student.companies.index', [
            'title' => 'Mes entreprises',
        ]);
    }

    public function create(): View
    {
        $student = loggedUser();

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

        $student = loggedUser();

        $this->companyRepository->createCompany($validated, $student);

        return redirect(route('student.companies.index'))->with('success', 'Votre entreprise a bien été créée !');
    }

    public function show(Company $company): View
    {
        $student = loggedUser();

        abort_if($this->companyRepository->checkCompanyIsInThisPromotion($student, $company->promotion_id), 403);

        return view('delmas.student.companies.show', [
            'title' => 'Fiche entreprise de '.$company->name,
            'company' => $company,
        ]);
    }

    public function edit(Company $company): View
    {
        $student = loggedUser();

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 403);

        return view('delmas.student.companies.edit', [
            'title' => 'Édition de '.$company->name,
            'company' => $company,
        ]);
    }

    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $student = loggedUser();

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 403);

        $this->companyRepository->updateCompany($validated, $company, $student);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été modifiée !');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $student = loggedUser();

        abort_if($this->companyRepository->companyBelongsToStudent($student, $company), 403);

        $this->companyRepository->deleteCompany($company);

        return redirect(route('student.companies.index'))->with('success', 'L\'entreprise '.$company->name.' a bien été supprimée !');
    }
}
