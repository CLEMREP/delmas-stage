<?php

namespace App\Http\Controllers\Student\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentAccountRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private StudentRepository $studentRepository)
    {
    }

    public function edit(Student $student): View
    {
        return view('delmas.student.account.account', ['title' => 'Mon compte', 'user' => loggedUser()]);
    }

    public function update(UpdateStudentAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        $validated['promotion_id'] = $user->promotion_id ?? null;

        $this->studentRepository->updateAccount($validated, $user);

        return redirect(route('student.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
