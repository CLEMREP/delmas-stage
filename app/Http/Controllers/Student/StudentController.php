<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\GoalRepository;
use App\Repositories\ProcedureRepository;
use Illuminate\Support\Facades\Auth;
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
        /** @var Student $student */
        $student = Auth::user()?->userable;

        return view('delmas.student.index',
            [
                'title' => 'Tableau de bord',
                'goals' => $this->goalRepository->allPaginated(),
                'procedures' => $this->procedureRepository->getProceduresOfStudentPaginated($student),
                'countProcedures' => $this->procedureRepository->getProceduresOfStudent($student)->count(),
                'waitingProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($student, 1),
                'refusedProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($student, 2),
                'acceptedProcedures' => $this->procedureRepository->countProceduresOfStudentWithStatus($student, 3),
            ]
        );
    }
}
