<?php

namespace App\Http\Livewire\Student;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public string $search = '';

    public function render()
    {
        $student = loggedUser();

        return view('livewire.student.contacts-table', [
            'contacts' => Contact::with('student')
                ->where('user_id', $student->getKey())
                ->scopes(['search' => $this->search])
                ->paginate(10),
        ]);
    }
}
