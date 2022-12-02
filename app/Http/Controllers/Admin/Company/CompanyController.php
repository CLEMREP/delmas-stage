<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.admin.companies.index', [
            'title' => 'Liste des entreprises',
        ]);
    }

    public function show(Company $company): View
    {
        $admin = loggedUser();

        abort_if($this->companyRepository->checkAdminHasThisCompany($admin, $company), 403);

        return view('delmas.admin.companies.show', [
            'title' => 'Fiche entreprise de '.$company->name,
            'company' => $company,
            'contact' => $company->contact,
        ]);
    }
}
