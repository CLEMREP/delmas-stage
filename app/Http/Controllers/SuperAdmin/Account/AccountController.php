<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeacherAccountRequest;
use App\Repositories\SuperAdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private SuperAdminRepository $superAdminRepository)
    {
    }

    public function edit(): View
    {
        return view('delmas.superadmin.account.account', ['title' => 'Mon compte', 'user' => loggedUser()]);
    }

    public function update(UpdateTeacherAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        $this->superAdminRepository->updateAccount($validated, $user);

        return redirect(route('superadmin.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
