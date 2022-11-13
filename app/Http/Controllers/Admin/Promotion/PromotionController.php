<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdatePromotionRequest;
use App\Models\Promotion;
use App\Repositories\AdminRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\SerieRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private AdminRepository $adminRepository,
        private SerieRepository $serieRepository
    ) {
    }

    public function index(): View
    {
        $admin = loggedUser();
        return view('delmas.admin.promotions.index', [
            'title' => 'Liste des promotions',
            'promotions' => $this->promotionRepository->getPromotionsInSeriesPaginated($admin),
        ]);
    }

    public function create(): View
    {
        $admin = loggedUser();

        return view('delmas.admin.promotions.create', [
            'title' => 'Création d\'une promotion',
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
            'series' => $admin->series,
        ]);
    }

    public function store(StoreOrUpdatePromotionRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $admin = loggedUser();

        abort_if($this->adminRepository->checkAdminHasThisSerie($admin, $validated['serie_id']), 403);

        $this->promotionRepository->createPromotion($validated);
        return redirect(route('admin.promotions.index'))->with('success', 'Votre promotion a bien été créée !');
    }

    public function edit(Promotion $promotion): View
    {
        $admin = loggedUser();

        return view('delmas.admin.promotions.edit', [
            'title' => 'Édition d\'une promotion',
            'promotion' => $promotion,
            'series' => $admin->series,
        ]);
    }

    public function update(StoreOrUpdatePromotionRequest $request, Promotion $promotion): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $admin = loggedUser();

        abort_if($this->adminRepository->checkAdminHasThisSerie($admin, $validated['serie_id']), 403);

        $this->promotionRepository->updatePromotion($validated, $promotion);
        return redirect(route('admin.promotions.index'))->with('success', 'Votre promotion a bien été modifiée !');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $this->promotionRepository->deletePromotion($promotion);
        return redirect(route('admin.promotions.index'))->with('success', 'Votre promotion a bien été supprimée !');
    }
}
