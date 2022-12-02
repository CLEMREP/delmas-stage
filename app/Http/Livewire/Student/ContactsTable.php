<?php

namespace App\Http\Livewire\Student;

use App\Models\Contact;
use Illuminate\Database\Query\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public function render(): View
    {
        $student = loggedUser();

        /** @var Builder $request */
        $request = Contact::with('student')
            ->where('user_id', $student->getKey())
            ->scopes(['search' => $this->search]);

        return view('livewire.student.contacts-table', [
            'contacts' => $request->paginate(12),
        ]);
    }
}
