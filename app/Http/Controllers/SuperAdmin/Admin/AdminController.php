<?php

namespace App\Http\Controllers\SuperAdmin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Enums\Roles;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\SerieRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private AdminRepository $adminRepository,
        private SerieRepository $serieRepository,
    ) {
    }

    public function index(): View
    {
        return view('delmas.superadmin.admin.index', [
            'title' => 'Gestion des admins',
            'admins' => $this->adminRepository->allAdminsPaginated(),
        ]);
    }

    public function create(): View
    {
        return view('delmas.superadmin.admin.create', [
            'title' => 'Création d\'un admin',
            'series' => $this->serieRepository->allSeries(),
        ]);
    }

    public function store(StoreAdminRequest $request): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();
        $validated['serie_id'] = explode(',', $validated['serie_id']);

        $this->adminRepository->createAdmin($validated);

        return redirect()->route('superadmin.admin.index')
            ->with('success', 'L\'admin a bien été créé.');
    }

    public function edit(User $user): View
    {
        abort_if($user->role != Roles::Admin, 403);

        return view('delmas.superadmin.admin.edit', [
            'title' => 'Modifier l\'admin '.$user->fullname(),
            'admin' => $user,
            'series' => $this->serieRepository->allSeries(),
        ]);
    }

    public function update(UpdateAdminRequest $request, User $user): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();
        $validated['serie_id'] = explode(',', $validated['serie_id']);

        $this->adminRepository->updateAccount($validated, $user);

        return redirect()->route('superadmin.admin.index')->with('success', 'L\'admin '.$user->fullname().' a bien été modifié.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->adminRepository->delete($user);

        return redirect(route('superadmin.admin.index'))->with('success', 'L\'admin '.$user->fullname().' a bien été supprimée !');
    }
}
