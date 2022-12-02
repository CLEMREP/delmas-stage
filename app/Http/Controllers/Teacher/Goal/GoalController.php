<?php

namespace App\Http\Controllers\Teacher\Goal;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateGoalRequest;
use App\Models\Goal;
use App\Repositories\GoalRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GoalController extends Controller
{
    public function __construct(
        private GoalRepository $goalRepository,
        private TeacherRepository $teacherRepository,
    ) {
    }

    public function index(): View
    {
        $user = loggedUser();

        return view('delmas.teacher.goals.index', [
            'title' => 'Les objectifs',
            'goals' => $this->goalRepository->getGoalsByPromotionsPaginated($user->promotions),
        ]);
    }

    public function create(): View
    {
        $user = loggedUser();

        return view('delmas.teacher.goals.create', [
            'title' => 'Création d\'un objectif',
            'promotions' => $user->promotions,
        ]);
    }

    public function store(StoreOrUpdateGoalRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        abort_if($this->teacherRepository->checkTeacherHasThisPromotion($user, $validated['promotion_id']), 403);

        $this->goalRepository->createGoal($validated);

        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été crée !');
    }

    public function edit(Goal $goal): View
    {
        $user = loggedUser();

        return view('delmas.teacher.goals.edit', [
            'title' => 'Édition d\'un objectif',
            'goal' => $goal,
            'promotions' => $user->promotions,
        ]);
    }

    public function update(StoreOrUpdateGoalRequest $request, Goal $goal): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        abort_if($this->teacherRepository->checkTeacherHasThisPromotion($user, $validated['promotion_id']), 403);

        $this->goalRepository->updateGoal($validated, $goal);

        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été modifié !');
    }

    public function destroy(Goal $goal): RedirectResponse
    {
        $this->goalRepository->deleteGoal($goal);

        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été supprimé !');
    }
}
