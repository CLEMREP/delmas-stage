<?php

namespace App\Http\Controllers\Student\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentAccountRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private StudentRepository $studentRepository)
    {
    }

    public function edit(Student $student): View
    {
        return view('delmas.student.account.account', ['title' => 'Mon compte', 'user' => Auth::user()]);
    }

    public function update(UpdateStudentAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Student $student */
        $student = Auth::user()?->userable;

        $this->studentRepository->updateAccount($validated, $student);

        return redirect(route('student.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
