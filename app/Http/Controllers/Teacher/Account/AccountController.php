<?php

namespace App\Http\Controllers\Teacher\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeacherAccountRequest;
use App\Repositories\TeacherRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private TeacherRepository $teacherRepository)
    {
    }

    public function edit(): View
    {
        return view('delmas.teacher.account.account', ['title' => 'Mon compte', 'user' => loggedUser()]);
    }

    public function update(UpdateTeacherAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        $this->teacherRepository->updateAccount($validated, $user);

        return redirect(route('teacher.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
