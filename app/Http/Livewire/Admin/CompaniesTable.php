<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use Illuminate\Database\Query\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniesTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public function render(): View
    {
        $admin = loggedUser();

        /** @var Builder $request */
        $request = Company::with('student')
            ->whereHas('student', fn ($q) => $q->whereHas('promotion', fn ($q) => $q->whereHas('serie', fn ($q) => $q->whereIn('id', $admin->series->pluck('id')))))
            ->scopes(['search' => $this->search]);

        return view('livewire.admin.companies-table', [
            'companies' => $request->paginate(15),
        ]);
    }
}
