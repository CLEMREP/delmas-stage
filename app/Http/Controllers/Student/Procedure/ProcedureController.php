<?php

namespace App\Http\Controllers\Student\Procedure;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcedureRequest;
use App\Models\Procedure;
use App\Models\Student;
use App\Repositories\CompanyRepository;
use App\Repositories\FormatRepository;
use App\Repositories\ProcedureRepository;
use App\Repositories\StatusRepository;
use App\Repositories\StudentRepository;
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
        private StudentRepository $studentRepository,
    ) {
    }

    public function index(): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $procedures = $this->procedureRepository->getProceduresOfStudentPaginated($student);

        return view('delmas.student.procedures.index', [
            'title' => 'Mes démarches',
            'procedures' => $procedures,
        ]);
    }

    public function create(): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $companies = $this->companyRepository->getCompaniesOfStudent($student);
        $formats = $this->formatRepository->getAllFormats();
        $statuses = $this->statusRepository->getAllStatuses();

        return view('delmas.student.procedures.create', [
            'title' => 'Création d\'une procédure',
            'companies' => $companies,
            'formats' => $formats,
            'statuses' => $statuses,
        ]);
    }

    public function store(ProcedureRequest $request): RedirectResponse
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var array $validated */
        $validated = $request->validated();

        $validated['student_id'] = $student->getKey();
        $validated['promotion_id'] = $student->promotion?->getKey();

        abort_if($this->studentRepository->checkStudentHasThisCompany($student, $validated['company_id']), 404);

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
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $procedureId */
        $procedureId = $procedure->getKey();

        abort_if($this->studentRepository->checkStudentHasThisProcedure($student, $procedureId), 404);

        return view('delmas.student.procedures.show', [
            'title' => 'Fiche de la démarche '.$procedure->company()->first()?->name,
            'procedure' => $procedure,
        ]);
    }

    public function edit(Procedure $procedure): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

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
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var array $validated */
        $validated = $request->validated();

        $validated['student_id'] = $student->getKey();

        abort_if($this->studentRepository->checkStudentHasThisCompany($student, $validated['company_id']), 404);

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
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $procedureId */
        $procedureId = $procedure->getKey();

        abort_if($this->studentRepository->checkStudentHasThisProcedure($student, $procedureId), 404);

        $this->procedureRepository->deleteProcedure($procedure);

        return redirect(route('student.procedures.index'))->with('success', 'La démarche de '.$procedure->company()->first()?->name.' a bien été supprimée !');
    }
}
