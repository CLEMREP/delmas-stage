<?php

namespace App\Http\Livewire\Teacher;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class StudentsTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public string $promotion = '';

    public string $sortField = 'promotion_id';

    public string $sortDirection = 'asc';

    public function resetFilters(): void
    {
        $this->reset(['search', 'promotion', 'sortField', 'sortDirection']);
    }

    public function render(): View
    {
        $teacher = loggedUser();

        return view('livewire.teacher.students-table', [
            'students' => User::student()->search($this->search)->with('promotion')
                ->whereHas('promotion', fn ($q) => $q->whereHas('teachers', fn ($q) => $q->where('id', $teacher->getKey())))
                ->when($this->promotion, fn ($q) => $q->where('promotion_id', $this->promotion))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
        ]);
    }
}
