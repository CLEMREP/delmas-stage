<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentOrTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Company;
use App\Models\Teacher;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\SerieRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private TeacherRepository $teacherRepository,
        private AdminRepository $adminRepository,
        private SerieRepository $serieRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.admin.teacher.index', [
            'title' => 'Gestion des professeurs',
        ]);
    }

    public function create(): View
    {
        $admin = loggedUser();

        return view('delmas.admin.teacher.create', [
            'title' => 'Création d\'un professeur',
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
        ]);
    }

    public function store(StoreStudentOrTeacherRequest $request): RedirectResponse
    {
        $admin = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->serieRepository->checkSeriesHasThisPromotion($admin, $validated['promotion_id']), 403);

        $this->teacherRepository->create($validated);

        return redirect()->route('admin.teacher.index')
            ->with('success', 'Le professeur a bien été créé.');
    }

    public function edit(User $user): View
    {
        $admin = loggedUser();

        return view('delmas.admin.teacher.edit', [
            'title' => 'Modifier le professeur ' . $user->fullname(),
            'teacher' => $user,
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
        ]);
    }

    public function update(UpdateStudentRequest $request, User $user): RedirectResponse
    {
        $admin = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->adminRepository->checkAdminHasThisTeacher($admin, $user), 403);

        $this->teacherRepository->updateAccount($validated, $user);
        return redirect()->route('admin.teacher.index')->with('success', 'Le professeur ' . $user->fullname() . ' a bien été modifié.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $admin = loggedUser();

        abort_if($this->adminRepository->checkAdminHasThisTeacher($admin, $user), 403);

        $this->teacherRepository->delete($user);
        return redirect(route('admin.teacher.index'))->with('success', 'L\'étudiant '.$user->fullname() . ' a bien été supprimée !');
    }
}
