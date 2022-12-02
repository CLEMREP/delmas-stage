<?php

namespace App\Http\Livewire\Student;

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
        $student = loggedUser();

        /** @var Builder $request */
        $request = Company::with('student')
            ->whereHas('student', fn ($q) => $q->whereHas('promotion', fn ($q) => $q->where('promotion_id', $student->promotion->getKey())))
            ->scopes(['search' => $this->search]);

        return view('livewire.student.companies-table', [
            'companies' => $request->paginate(12),
        ]);
    }
}
