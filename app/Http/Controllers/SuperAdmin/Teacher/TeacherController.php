<?php

namespace App\Http\Controllers\SuperAdmin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentOrTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Enums\Roles;
use App\Models\User;
use App\Repositories\PromotionRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private TeacherRepository $teacherRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.superadmin.teacher.index', [
            'title' => 'Gestion des professeurs',
        ]);
    }

    public function create(): View
    {
        return view('delmas.superadmin.teacher.create', [
            'title' => 'Création d\'un professeur',
            'promotions' => $this->promotionRepository->getAllPromotions(),
        ]);
    }

    public function store(StoreStudentOrTeacherRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();
        $validated['promotion_id'] = explode(',', $validated['promotion_id']);

        $this->teacherRepository->create($validated);

        return redirect()->route('superadmin.teacher.index')
            ->with('success', 'Le professeur a bien été créé.');
    }

    public function edit(User $user): View
    {
        $admin = loggedUser();

        abort_if($user->role != Roles::Teacher, 403);

        return view('delmas.superadmin.teacher.edit', [
            'title' => 'Modifier le professeur '.$user->fullname(),
            'teacher' => $user,
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
        ]);
    }

    public function update(UpdateStudentRequest $request, User $user): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();
        $validated['promotion_id'] = explode(',', $validated['promotion_id']);

        $this->teacherRepository->updateAccount($validated, $user);

        return redirect()->route('superadmin.teacher.index')->with('success', 'Le professeur '.$user->fullname().' a bien été modifié.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->teacherRepository->delete($user);

        return redirect(route('superadmin.teacher.index'))->with('success', 'Le professeur '.$user->fullname().' a bien été supprimée !');
    }
}
