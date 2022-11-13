<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Repositories\GoalRepository;
use App\Repositories\ProcedureRepository;
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
        $user = loggedUser();

        return view('delmas.teacher.index',
            [
                'title' => 'Tableau de bord',
                'goals' => $this->goalRepository->getGoalsByPromotions($user->promotions),
                'procedures' => $this->procedureRepository->getAllProceduresOfPromotionsPaginated($user->promotions, 10),
                'countProcedures' => $this->procedureRepository->getAllProceduresOfPromotions($user->promotions)->count(),
                'waitingProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($user->promotions, 1)->count(),
                'refusedProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($user->promotions, 2)->count(),
                'acceptedProcedures' => $this->procedureRepository->getAllProceduresOfPromotionsWithStatus($user->promotions, 3)->count(),
            ]
        );
    }
}
