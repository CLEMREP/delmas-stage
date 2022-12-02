<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\ProcedureRepository;
use App\Repositories\SerieRepository;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private AdminRepository $adminRepository,
        private SerieRepository $serieRepository,
        private CompanyRepository $companyRepository,
        private ProcedureRepository $procedureRepository,
    ) {
    }

    public function index(): View
    {
        $admin = loggedUser();

        return view('delmas.admin.index', [
            'title' => 'Administration',
            'countUsers' => $this->adminRepository->countUsersInAdminSeries($admin),
            'countPromotions' => $this->serieRepository->countPromotionsInSeries($admin),
            'countProcedures' => $this->procedureRepository->countProceduresInSeries($admin),
            'countCompanies' => $this->companyRepository->countCompaniesInSeries($admin),
        ]);
    }
}
