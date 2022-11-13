<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Company;
use App\Models\Teacher;
use App\Models\User;
use App\Repositories\PromotionRepository;
use App\Repositories\SerieRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private StudentRepository $studentRepository,
        private SerieRepository $serieRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.admin.student.index', [
            'title' => 'Gestion des étudiants',
        ]);
    }

    public function show(User $user): View
    {
        return view('delmas.admin.student.show', [
            'title' => 'Détails de l\'étudiant ' . $user->fullname(),
            'student' => $user,
        ]);
    }

    public function create(): View
    {
        $admin = loggedUser();

        return view('delmas.admin.student.create', [
            'title' => 'Création d\'un étudiant',
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
        ]);
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $admin = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->serieRepository->checkSeriesHasThisPromotion($admin, $validated['promotion_id']), 403);

        $this->studentRepository->create($validated);

        return redirect()->route('admin.student.index')
            ->with('success', 'L\'étudiant a bien été créé.');
    }

    public function edit(User $user): View
    {
        $admin = loggedUser();

        return view('delmas.admin.student.edit', [
            'title' => 'Modifier l\'étudiant ' . $user->fullname(),
            'student' => $user,
            'promotions' => $this->promotionRepository->getPromotionsInSeries($admin),
        ]);
    }

    public function update(UpdateStudentRequest $request, User $user): RedirectResponse
    {
        $admin = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        abort_if($this->studentRepository->checkAdminHasThisStudent($admin, $user), 403);

        $this->studentRepository->updateAccount($validated, $user);
        return redirect()->route('admin.student.index')->with('success', 'L\'étudiant ' . $user->fullname() . ' a bien été modifié.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $admin = loggedUser();

        abort_if($this->studentRepository->checkAdminHasThisStudent($admin, $user), 403);

        $this->studentRepository->delete($user);
        return redirect(route('admin.student.index'))->with('success', 'L\'étudiant '.$user->fullname() . ' a bien été supprimée !');
    }
}
