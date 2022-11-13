<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public string $search = '';

    public function render()
    {
        $admin = loggedUser();

        return view('livewire.admin.companies-table', [
            'companies' => Company::with('student')
                ->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->whereHas('serie', fn($q) => $q->whereIn('id', $admin->series->pluck('id')))))
                ->scopes(['search' => $this->search])
                ->paginate(15),
        ]);
    }
}
