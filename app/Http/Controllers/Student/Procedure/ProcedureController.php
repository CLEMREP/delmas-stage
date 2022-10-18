<?php

namespace App\Http\Controllers\Student\Procedure;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcedureRequest;
use App\Models\Procedure;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Repositories\FormatRepository;
use App\Repositories\ProcedureRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository,
        private CompanyRepository $companyRepository,
        private FormatRepository $formatRepository,
        private StatusRepository $statusRepository,
        private UserRepository $userRepository,
    )
    {
    }

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $procedures = $this->procedureRepository->getProceduresOfUser($user);

        return view('FrontDelmas.procedures.index', [
            'title' => 'Mes démarches',
            'procedures' => $procedures,
        ]);
    }

    public function create(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $companies = $this->companyRepository->getCompaniesOfUser($user);
        $formats = $this->formatRepository->getAllFormats();
        $statuses = $this->statusRepository->getAllStatuses();

        return view('FrontDelmas.procedures.create', [
            'title' => 'Création d\'une procédure',
            'companies' => $companies,
            'formats' => $formats,
            'statuses' => $statuses,
        ]);
    }

    public function store(ProcedureRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var array $validated */
        $validated = $request->validated();

        $validated['user_id'] = $user->getKey();
        $validated['promotion_id'] = $user->promotion->getKey();

        abort_if($this->userRepository->checkUserHasThisCompany($user, $validated['company_id']), 404);

        if (!is_null($this->statusRepository->findStatusById($validated)) && !is_null($this->formatRepository->findFormatById($validated))) {
            $this->procedureRepository->createProcedure($validated);
            return redirect(route('procedures.index'))->with('success', 'Votre démarche a bien été créée !');
        } else {
            return redirect(route('procedures.index'))->with('errors', 'La status ou format de votre démarche est introuvable !');
        }
    }

    public function show(Procedure $procedure): View
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if($this->userRepository->checkUserHasThisProcedure($user, $procedure->getKey()), 404);

        return view('FrontDelmas.procedures.show', [
            'title' => 'Fiche de la démarche '. $procedure->name,
            'procedure' => $procedure,
        ]);
    }

    public function edit(Procedure $procedure): View
    {
        /** @var User $user */
        $user = Auth::user();

        $companies = $this->companyRepository->getCompaniesOfUser($user);
        $formats = $this->formatRepository->getAllFormats();
        $statuses = $this->statusRepository->getAllStatuses();

        return view('FrontDelmas.procedures.edit', [
            'title' => 'Édition de la procédure '. $procedure->name,
            'procedure' => $procedure,
            'companies' => $companies,
            'formats' => $formats,
            'statuses' => $statuses,
        ]);
    }

    public function update(ProcedureRequest $request, Procedure $procedure): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var array $validated */
        $validated = $request->validated();

        $validated['user_id'] = $user->getKey();

        abort_if($this->userRepository->checkUserHasThisCompany($user, $validated['company_id']), 404);

        if (!is_null($this->statusRepository->findStatusById($validated)) && !is_null($this->formatRepository->findFormatById($validated))) {
            $this->procedureRepository->updateProcedure($procedure, $validated);
            return redirect(route('procedures.index'))->with('success', 'Votre démarche a bien été modifié !');
        } else {
            return redirect(route('procedures.index'))->with('errors', 'La status ou format de votre démarche est introuvable !');
        }
    }

    public function destroy(Procedure $procedure): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if($this->userRepository->checkUserHasThisProcedure($user, $procedure->getKey()), 404);

        $this->procedureRepository->deleteProcedure($procedure);
        return redirect(route('procedures.index'))->with('success', 'La démarche de ' . $procedure->company()->first()->name . ' a bien été supprimée !');
    }
}
