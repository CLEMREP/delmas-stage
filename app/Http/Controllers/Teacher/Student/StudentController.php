<?php

namespace App\Http\Controllers\Teacher\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\UserResource;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private TeacherRepository $teacherRepository,
        private StudentRepository $studentRepository
    )
    {
    }

    public function index(Request $request): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.student.index', [
            'title' => 'Mes élèves',
            'students' => $this->teacherRepository->allStudentsPaginated($teacher),
        ]);
    }

    public function show(Student $student): View
    {
        return view('delmas.teacher.student.show', [
            'title' => 'Fiche de l\'élève ' . $student->fullname(),
            'student' => $student,
        ]);
    }

    public function edit(Student $student): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.student.edit', [
            'title' => 'Modification de l\'élève ' . $student->fullname(),
            'student' => $student,
            'promotions' => $teacher->promotions,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $this->studentRepository->updateAccount($validated, $student);

        return redirect(route('teacher.student.index'))->with('success', 'L\'élève ' . $student->fullname() . ' a bien été effectuée !');
    }
}
