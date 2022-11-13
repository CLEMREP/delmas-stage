<?php

namespace App\Http\Livewire\Admin;

use App\Models\Procedure;
use App\Models\Serie;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProceduresTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public string $search = '';
    public string $serie = '';
    public string $status = '';
    public string $sortField = 'status_id';
    public string $sortDirection = 'desc';

    public function resetFilters(): void
    {
        $this->reset(['search', 'status', 'serie', 'sortField', 'sortDirection']);
    }

    public function render(): View
    {
        $admin = loggedUser();

        return view('livewire.admin.procedures-table', [
            'procedures' => Procedure::with(['student', 'company', 'status'])
                ->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->whereHas('serie', fn($q) => $q->whereIn('id', $admin->series->pluck('id')))))
                ->whereHas('student', fn($q) => $q->search($this->search))
                ->when($this->serie, fn($q) => $q->whereHas('student', fn($q) => $q->whereHas('promotion', fn($q) => $q->where('serie_id', $this->serie))))
                ->when($this->status, fn($q) => $q->where('status_id', $this->status))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15),
            'series' => Serie::query()
                ->whereIn('id', $admin->series->pluck('id'))
                ->get(),
        ]);
    }
}
