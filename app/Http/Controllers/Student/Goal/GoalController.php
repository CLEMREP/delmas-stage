<?php

namespace App\Http\Controllers\Student\Goal;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\GoalRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GoalController extends Controller
{
    public function __construct(private GoalRepository $goalRepository)
    {
    }

    public function index(): View
    {
        $user = loggedUser();

        return view('delmas.student.goals.index', [
            'title' => 'Les objectifs',
            'goals' => $this->goalRepository->getGoalsByPromotionPaginated($user->promotion),
        ]);
    }
}
