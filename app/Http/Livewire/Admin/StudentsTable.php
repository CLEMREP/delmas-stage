<?php

namespace App\Http\Livewire\Admin;

use App\Models\Enums\Roles;
use App\Models\Serie;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class StudentsTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public string $serie = '';

    public string $sortField = 'promotion_id';

    public string $sortDirection = 'asc';

    public function resetFilters(): void
    {
        $this->reset(['search', 'serie', 'sortField', 'sortDirection']);
    }

    public function render(): View
    {
        $admin = loggedUser();

        return view('livewire.admin.students-table', [
            'students' => User::search($this->search)->with('promotion')
                ->whereHas('promotion', fn ($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
                ->when($this->serie, fn ($q) => $q->whereHas('promotion', fn ($q) => $q->whereHas('serie', fn ($q) => $q->where('id', $this->serie))))
                ->orWhere('promotion_id', null)
                ->where('role', Roles::Student)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15),
            'series' => Serie::query()
                ->whereIn('id', $admin->series->pluck('id'))
                ->get(),
        ]);
    }
}
