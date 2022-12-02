<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\GoalRepository;
use App\Repositories\ProcedureRepository;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository,
        private GoalRepository $goalRepository,
    ) {
    }

    public function index(): View
    {
        $user = loggedUser();

        return view('delmas.student.index',
            [
                'title' => 'Tableau de bord',
                'goals' => $this->goalRepository->allPaginated(),
                'procedures' => $this->procedureRepository->getProceduresOfStudentPaginated($user),
                'countProcedures' => $this->procedureRepository->getProceduresOfStudent($user)->count(),
                'waitingProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($user, 1),
                'refusedProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($user, 2),
                'acceptedProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($user, 3),
            ]
        );
    }
}
