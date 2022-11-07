<?php

namespace App\Http\Controllers\Teacher\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentAccountRequest;
use App\Http\Requests\UpdateTeacherAccountRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private TeacherRepository $teacherRepository)
    {
    }

    public function edit(Teacher $teacher): View
    {
        return view('delmas.teacher.account.account', ['title' => 'Mon compte', 'user' => Auth::user()]);
    }

    public function update(UpdateTeacherAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        $this->teacherRepository->updateAccount($validated, $teacher);

        return redirect(route('teacher.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
