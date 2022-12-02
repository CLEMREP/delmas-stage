<?php

namespace App\Http\Controllers\SuperAdmin\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdatePromotionRequest;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use App\Repositories\SerieRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private SerieRepository $serieRepository
    ) {
    }

    public function index(): View
    {
        return view('delmas.superadmin.promotions.index', [
            'title' => 'Gestion des promotions',
            'promotions' => $this->promotionRepository->getAllPromotionsPaginated(),
        ]);
    }

    public function create(): View
    {
        return view('delmas.superadmin.promotions.create', [
            'title' => 'Création d\'une promotion',
            'promotions' => $this->promotionRepository->getAllPromotions(),
            'series' => $this->serieRepository->allSeries(),
        ]);
    }

    public function store(StoreOrUpdatePromotionRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->serieRepository->checkIfSerieExist($validated['serie_id']), 404);

        $this->promotionRepository->createPromotion($validated);

        return redirect(route('superadmin.promotions.index'))->with('success', 'Votre promotion a bien été créée !');
    }

    public function edit(Promotion $promotion): View
    {
        return view('delmas.superadmin.promotions.edit', [
            'title' => 'Édition d\'une promotion',
            'promotion' => $promotion,
            'series' => $this->serieRepository->allSeries(),
        ]);
    }

    public function update(StoreOrUpdatePromotionRequest $request, Promotion $promotion): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->serieRepository->checkIfSerieExist($validated['serie_id']), 404);

        $this->promotionRepository->updatePromotion($validated, $promotion);

        return redirect(route('superadmin.promotions.index'))->with('success', 'Votre promotion a bien été modifiée !');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $this->promotionRepository->deletePromotion($promotion);

        return redirect(route('superadmin.promotions.index'))->with('success', 'Votre promotion a bien été supprimée !');
    }
}
