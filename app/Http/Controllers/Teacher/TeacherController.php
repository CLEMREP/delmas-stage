<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Repositories\GoalRepository;
use App\Repositories\ProcedureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(
        private ProcedureRepository $procedureRepository,
        private GoalRepository $goalRepository,
    ) {
    }

    public function index(): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;


        return view('delmas.teacher.index',
            [
                'title' => 'Tableau de bord',
                'goals' => $this->goalRepository->getGoalsByPromotions($teacher->promotions),
                'procedures' => $this->procedureRepository->getAllProceduresOfPromotionsPaginated($teacher->promotions, 8),
                'countProcedures' => $this->procedureRepository->getAllProceduresOfPromotions($teacher->promotions)->count(),
                'waitingProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($teacher->promotions, 1)->count(),
                'refusedProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($teacher->promotions, 2)->count(),
                'acceptedProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($teacher->promotions, 3)->count(),
            ]
        );
    }
}
