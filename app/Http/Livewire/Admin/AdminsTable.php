<?php

namespace App\Http\Livewire\Admin;

use App\Models\Serie;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AdminsTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $serie = '';

    public string $sortField = 'serie_id';

    public string $sortDirection = 'asc';

    public function resetFilters(): void
    {
        $this->reset(['serie', 'sortField', 'sortDirection']);
    }

    public function render(): View
    {
        return view('livewire.admin.admins-table', [
            'admins' => User::admin()->with('series')
                            ->orderBy($this->sortField, $this->sortDirection)
                            ->paginate(15),
            'series' => Serie::all(),
        ]);
    }
}
