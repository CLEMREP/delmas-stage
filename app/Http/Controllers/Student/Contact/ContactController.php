<?php

namespace App\Http\Controllers\Student\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Student;
use App\Models\User;
use App\Repositories\ContactRepository;
use App\Repositories\JobRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        private ContactRepository $contactRepository,
        private JobRepository $jobRepository,
        private StudentRepository $studentRepository,
    ) {
    }

    public function index(): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        $contacts = $this->contactRepository->getContactsOfStudentPaginated($student);

        return view('delmas.student.contacts.index', [
            'title' => 'Mes contacts',
            'contacts' => $contacts,
        ]);
    }

    public function create(): View
    {
        $jobs = $this->jobRepository->getAllJobs();

        return view('delmas.student.contacts.create', [
            'title' => 'Création d\'un contact',
            'jobs' => $jobs,
        ]);
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        /** @var User $student */
        $student = Auth::user()?->userable;

        /** @var array $validated */
        $validated = $request->validated();

        /** @var int $jobId */
        $jobId = $validated['job_id'];

        $validated['student_id'] = $student->getKey();

        if (! is_null($this->jobRepository->findJobById($jobId))) {
            $this->contactRepository->createContact($validated);

            return redirect(route('student.contacts.index'))->with('success', 'Votre contact a bien été crée !');
        } else {
            return redirect(route('student.contacts.index'))->with('errors', 'La fonction de votre contact est introuvable !');
        }
    }

    public function show(Contact $contact): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $contact->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        return view('delmas.student.contacts.show', [
            'title' => 'Fiche contact de '.$contact->firstname.' '.$contact->name,
            'contact' => $contact,
        ]);
    }

    public function edit(Contact $contact): View
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $contact->getKey();

        $jobs = $this->jobRepository->getAllJobs();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        return view('delmas.student.contacts.edit', [
            'title' => 'Édition de '.$contact->firstname.' '.$contact->name,
            'contact' => $contact,
            'jobs' => $jobs,
        ]);
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $contact->getKey();

        $validated['student_id'] = $student->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        $this->contactRepository->updateContact($validated, $contact);

        return redirect(route('student.contacts.index'))->with('success', $contact->firstname.' '.$contact->name.' a bien été modifiée !');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        /** @var Student $student */
        $student = Auth::user()?->userable;

        /** @var int $contactId */
        $contactId = $contact->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        $this->contactRepository->deleteContact($contact);

        return redirect(route('student.contacts.index'))->with('success', 'Le contact '.$contact->firstname.' '.$contact->name.' a bien été supprimée !');
    }
}
