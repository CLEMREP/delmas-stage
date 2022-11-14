<?php

namespace App\Http\Livewire\Admin;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TeachersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

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
        $admin = loggedUser();

        return view('livewire.admin.teachers-table', [
            'teachers' => User::teacher()->search($this->search)->with('promotions')
                ->whereHas('promotions', fn($q) => $q->whereIn('serie_id', $admin->series->pluck('id')))
                ->when($this->promotion, fn($q) => $q->whereHas('promotions', fn($q) => $q->where('id', $this->promotion)))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15),
            'promotions' => Promotion::query()
                ->whereHas('serie', fn($q) => $q->whereIn('id', $admin->series->pluck('id')))
                ->get(),
        ]);
    }
}
