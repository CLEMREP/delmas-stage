<?php

namespace App\Http\Controllers\Student\Procedure;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcedureRequest;
use App\Models\Procedure;
use App\Repositories\CompanyRepository;
use App\Repositories\FormatRepository;
use App\Repositories\ProcedureRepository;
use App\Repositories\StatusRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository,
        private CompanyRepository $companyRepository,
        private FormatRepository $formatRepository,
        private StatusRepository $statusRepository,
        private StudentRepository $studentRepository,
    ) {
    }

    public function index(): View
    {
        $student = loggedUser();

        $procedures = $this->procedureRepository->getProceduresOfStudentPaginated($student);

        return view('delmas.student.procedures.index', [
            'title' => 'Mes démarches',
            'procedures' => $procedures,
        ]);
    }

    public function create(): View
    {
        $formats = $this->formatRepository->getAllFormats();
        $statuses = $this->statusRepository->getAllStatuses();

        return view('delmas.student.procedures.create', [
            'title' => 'Création d\'une procédure',
            'formats' => $formats,
            'statuses' => $statuses,
        ]);
    }

    public function store(ProcedureRequest $request): RedirectResponse
    {
        $student = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        $validated['user_id'] = $student->getKey();
        $validated['promotion_id'] = $student->promotion->getKey();

        abort_if($this->companyRepository->checkCompanyIsInThisPromotion($student, $this->companyRepository->findCompanyById($validated['company_id'])?->promotion_id), 403);
        abort_if($this->companyRepository->checkCompanyHasThisContact($validated['company_id'], $validated['contact_id']), 403);

        if (! is_null($this->statusRepository->findStatusById($validated)) && ! is_null($this->formatRepository->findFormatById($validated))) {
            $this->procedureRepository->createProcedure($validated);

            return redirect(route('student.procedures.index'))
                ->with('success', 'Votre démarche a bien été créée !');
        } else {
            return redirect(route('student.procedures.index'))
                ->with('errors', 'La status ou format de votre démarche est introuvable !');
        }
    }

    public function show(Procedure $procedure): View
    {
        $student = loggedUser();

        /** @var int $procedureId */
        $procedureId = $procedure->getKey();

        abort_if($this->studentRepository->checkStudentHasThisProcedure($student, $procedureId), 403);

        return view('delmas.student.procedures.show', [
            'title' => 'Fiche de la démarche '.$procedure->company()->first()?->name,
            'procedure' => $procedure,
        ]);
    }

    public function edit(Procedure $procedure): View
    {
        $student = loggedUser();

        $companies = $this->companyRepository->getCompaniesOfStudent($student);
        $formats = $this->formatRepository->getAllFormats();
        $statuses = $this->statusRepository->getAllStatuses();

        return view('delmas.student.procedures.edit', [
            'title' => 'Édition de la procédure '.$procedure->company()->first()?->name,
            'procedure' => $procedure,
            'companies' => $companies,
            'formats' => $formats,
            'statuses' => $statuses,
        ]);
    }

    public function update(ProcedureRequest $request, Procedure $procedure): RedirectResponse
    {
        $student = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        $validated['user_id'] = $student->getKey();

        abort_if($this->studentRepository->checkStudentHasThisCompany($student, $validated['company_id']), 403);

        if (! is_null($this->statusRepository->findStatusById($validated)) && ! is_null($this->formatRepository->findFormatById($validated))) {
            $this->procedureRepository->updateProcedure($procedure, $validated);

            return redirect(route('student.procedures.index'))
                ->with('success', 'Votre démarche a bien été modifié !');
        } else {
            return redirect(route('student.procedures.index'))
                ->with('errors', 'La status ou format de votre démarche est introuvable !');
        }
    }

    public function destroy(Procedure $procedure): RedirectResponse
    {
        $student = loggedUser();

        /** @var int $procedureId */
        $procedureId = $procedure->getKey();

        abort_if($this->studentRepository->checkStudentHasThisProcedure($student, $procedureId), 403);

        $this->procedureRepository->deleteProcedure($procedure);

        return redirect(route('student.procedures.index'))->with('success', 'La démarche de '.$procedure->company()->first()?->name.' a bien été supprimée !');
    }
}
