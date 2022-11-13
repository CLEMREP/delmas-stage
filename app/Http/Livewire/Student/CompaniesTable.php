<?php

namespace App\Http\Livewire\Student;

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
        $student = loggedUser();

        return view('livewire.student.companies-table',[
            'companies' => Company::with('student')
                ->where('user_id', $student->getKey())
                ->scopes(['search' => $this->search])
                ->paginate(10),
        ]);
    }
}
