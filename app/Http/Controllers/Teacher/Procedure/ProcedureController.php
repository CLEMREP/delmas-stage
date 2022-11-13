<?php

namespace App\Http\Controllers\Teacher\Procedure;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
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
        $user = loggedUser();

        return view('delmas.teacher.procedure.index', [
            'title' => 'Suivi des démarches',
            'procedures' => $this->procedureRepository->getAllProceduresOfPromotionsPaginated($user->promotions, 10),
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