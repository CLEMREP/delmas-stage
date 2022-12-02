<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeacherAccountRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private AdminRepository $adminRepository)
    {
    }

    public function edit(): View
    {
        return view('delmas.admin.account.account', ['title' => 'Mon compte', 'user' => loggedUser()]);
    }

    public function update(UpdateTeacherAccountRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $user = loggedUser();

        $this->adminRepository->updateAccount($validated, $user);

        return redirect(route('admin.account.edit'))->with('success', 'La modification du compte a bien été effectuée !');
    }
}
