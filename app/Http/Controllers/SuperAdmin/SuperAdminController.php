<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\SerieRepository;
use App\Repositories\SuperAdminRepository;
use Illuminate\View\View;

class SuperAdminController extends Controller
{
    public function __construct(
        private SuperAdminRepository $superAdminRepository,
        private SerieRepository $serieRepository,
        private PromotionRepository $promotionRepository,
        private AdminRepository $adminRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.superadmin.index', [
            'title' => 'Administration',
            'countUsers' => $this->superAdminRepository->countUsers(),
            'countSeries' => $this->serieRepository->countSeries(),
            'countPromotions' => $this->promotionRepository->countPromotions(),
            'countAdmins' => $this->adminRepository->countAdmins(),
        ]);
    }
}
