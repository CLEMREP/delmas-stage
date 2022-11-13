<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Procedure;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProceduresTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public string $search = '';
    public string $promotion = '';
    public string $status = '';
    public string $sortField = 'status_id';
    public string $sortDirection = 'desc';

    public function resetFilters(): void
    {
        $this->reset(['search', 'status', 'promotion', 'sortField', 'sortDirection']);
    }

    public function render(): View
    {
        $teacher = loggedUser();

        return view('livewire.teacher.procedures-table', [
            'procedures' => Procedure::with(['student', 'company', 'status'])
                ->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->whereHas('teachers', fn($q) => $q->where('id', $teacher->getKey()))))
                ->whereHas('student', fn($q) => $q->search($this->search))
                ->when($this->promotion, fn($q) => $q->whereHas('student', fn ($q) => $q->where('promotion_id', $this->promotion)))
                ->when($this->status, fn($q) => $q->where('status_id', $this->status))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15),
        ]);
    }
}
