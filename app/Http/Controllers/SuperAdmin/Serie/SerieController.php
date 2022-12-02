<?php

namespace App\Http\Controllers\SuperAdmin\Serie;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateSerieRequest;
use App\Models\Serie;
use App\Repositories\SerieRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SerieController extends Controller
{
    public function __construct(
        private SerieRepository $serieRepository
    ) {
    }

    public function index(): View
    {
        return view('delmas.superadmin.series.index', [
            'title' => 'Gestion des séries',
            'series' => $this->serieRepository->allSeriesPaginated(),
        ]);
    }

    public function create(): View
    {
        return view('delmas.superadmin.series.create', [
            'title' => 'Création d\'une série',
        ]);
    }

    public function store(StoreOrUpdateSerieRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $this->serieRepository->createSerie($validated);

        return redirect(route('superadmin.series.index'))->with('success', 'Votre série a bien été créée !');
    }

    public function edit(Serie $serie): View
    {
        return view('delmas.superadmin.series.edit', [
            'title' => 'Édition d\'une série',
            'serie' => $serie,
        ]);
    }

    public function update(StoreOrUpdateSerieRequest $request, Serie $serie): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $this->serieRepository->updateSerie($validated, $serie);

        return redirect(route('superadmin.series.index'))->with('success', 'Votre série a bien été modifiée !');
    }

    public function destroy(Serie $serie): RedirectResponse
    {
        $this->serieRepository->deleteSerie($serie);

        return redirect(route('superadmin.series.index'))->with('success', 'Votre série a bien été supprimée !');
    }
}
