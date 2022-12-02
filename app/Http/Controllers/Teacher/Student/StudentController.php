<?php

namespace App\Http\Controllers\Teacher\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private TeacherRepository $teacherRepository,
        private StudentRepository $studentRepository
    ) {
    }

    public function index(Request $request): View
    {
        $user = loggedUser();

        return view('delmas.teacher.student.index', [
            'title' => 'Mes élèves',
            'students' => $this->teacherRepository->allStudents($user),
        ]);
    }

    public function show(User $user): View
    {
        abort_if($this->teacherRepository->checkTeacherHasThisStudent($user), 403);

        return view('delmas.teacher.student.show', [
            'title' => 'Fiche de l\'élève '.$user->fullname(),
            'student' => $user,
        ]);
    }

    public function edit(User $user): View
    {
        $teacher = loggedUser();

        return view('delmas.teacher.student.edit', [
            'title' => 'Modification de l\'élève '.$user->fullname(),
            'student' => $user,
            'promotions' => $teacher->promotions,
        ]);
    }

    public function update(UpdateStudentRequest $request, User $user): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $this->studentRepository->updateAccount($validated, $user);

        return redirect(route('teacher.student.index'))->with('success', 'L\'élève '.$user->fullname().' a bien été effectuée !');
    }
}
