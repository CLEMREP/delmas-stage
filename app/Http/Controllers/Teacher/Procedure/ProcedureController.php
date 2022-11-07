<?php

namespace App\Http\Controllers\Teacher\Procedure;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use App\Models\Teacher;
use App\Repositories\ProcedureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository
    )
    {
    }

    public function index(): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.procedure.index', [
            'title' => 'Suivi des démarches',
            'procedures' => $this->procedureRepository->getAllProceduresOfPromotionsPaginated($teacher->promotions, 10),
        ]);
    }

    public function show(Procedure $procedure): View
    {
        return view('delmas.teacher.procedure.show', [
            'title' => 'Fiche de la démarche',
            'procedure' => $procedure,
        ]);
    }
}