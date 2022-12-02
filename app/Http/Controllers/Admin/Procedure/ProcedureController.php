<?php

namespace App\Http\Controllers\Admin\Procedure;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository
    ) {
    }

    public function index(): View
    {
        $admin = loggedUser();

        return view('delmas.admin.procedure.index', [
            'title' => 'Suivi des démarches',
            'procedures' => $this->procedureRepository->getProceduresInSeriesPaginated($admin, 10),
        ]);
    }

    public function show(Procedure $procedure): View
    {
        return view('delmas.admin.procedure.show', [
            'title' => 'Fiche de la démarche',
            'procedure' => $procedure,
        ]);
    }
}
