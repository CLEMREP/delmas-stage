<?php

namespace App\Http\Controllers\Teacher\Goal;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateGoalRequest;
use App\Models\Goal;
use App\Models\Teacher;
use App\Repositories\GoalRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GoalController extends Controller
{
    public function __construct(
        private GoalRepository $goalRepository,
        private TeacherRepository $teacherRepository,
    )
    {
    }

    public function index(): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.goals.index', [
            'title' => 'Les objectifs',
            'goals' => $this->goalRepository->getGoalsByPromotionsPaginated($teacher->promotions),
        ]);
    }

    public function create(): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.goals.create', [
            'title' => 'Création d\'un objectif',
            'promotions' => $teacher->promotions,
        ]);
    }

    public function store(StoreOrUpdateGoalRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        abort_if($this->teacherRepository->checkTeacherHasThisPromotion($teacher, $validated['promotion_id']), 403);

        $this->goalRepository->createGoal($validated);
        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été crée !');
    }

    public function edit(Goal $goal): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.goals.edit', [
            'title' => 'Édition d\'un objectif',
            'goal' => $goal,
            'promotions' => $teacher->promotions,
        ]);
    }


    public function update(StoreOrUpdateGoalRequest $request, Goal $goal): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        abort_if($this->teacherRepository->checkTeacherHasThisPromotion($teacher, $validated['promotion_id']), 403);

        $this->goalRepository->updateGoal($validated, $goal);
        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été modifié !');
    }

    public function destroy(Goal $goal): RedirectResponse
    {
        $this->goalRepository->deleteGoal($goal);
        return redirect(route('teacher.goals.index'))->with('success', 'Votre objectif a bien été supprimé !');
    }
}
