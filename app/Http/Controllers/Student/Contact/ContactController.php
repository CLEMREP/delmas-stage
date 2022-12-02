<?php

namespace App\Http\Controllers\Student\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;
use App\Repositories\JobRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        private ContactRepository $contactRepository,
        private JobRepository $jobRepository,
        private StudentRepository $studentRepository,
        private CompanyRepository $companyRepository,
    ) {
    }

    public function index(): View
    {
        $user = loggedUser();

        $contacts = $this->contactRepository->getContactsOfStudentPaginated($user);

        return view('delmas.student.contacts.index', [
            'title' => 'Mes contacts',
            'contacts' => $contacts,
        ]);
    }

    public function create(): View
    {
        $student = loggedUser();
        $jobs = $this->jobRepository->getAllJobs();

        return view('delmas.student.contacts.create', [
            'title' => 'Création d\'un contact',
            'companies' => $this->companyRepository->getCompaniesOfPromotion($student->promotion->id),
            'jobs' => $jobs,
        ]);
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $student = loggedUser();

        /** @var array $validated */
        $validated = $request->validated();

        /** @var int $jobId */
        $jobId = $validated['job_id'];

        $validated['user_id'] = $student->getKey();

        if (! is_null($this->jobRepository->findJobById($jobId))) {
            $this->contactRepository->createContact($validated);

            return redirect(route('student.contacts.index'))->with('success', 'Votre contact a bien été crée !');
        } else {
            return redirect(route('student.contacts.index'))->with('errors', 'La fonction de votre contact est introuvable !');
        }
    }

    public function show(Contact $contact): View
    {
        $user = loggedUser();

        /** @var int $contactId */
        $contactId = $contact->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($user, $contactId), 403);

        return view('delmas.student.contacts.show', [
            'title' => 'Fiche contact de '.$contact->firstname.' '.$contact->name,
            'contact' => $contact,
        ]);
    }

    public function edit(Contact $contact): View
    {
        $student = loggedUser();

        /** @var int $contactId */
        $contactId = $contact->getKey();

        $jobs = $this->jobRepository->getAllJobs();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 403);

        return view('delmas.student.contacts.edit', [
            'title' => 'Édition de '.$contact->firstname.' '.$contact->name,
            'companies' => $this->companyRepository->getCompaniesOfPromotion($student->promotion->id),
            'contact' => $contact,
            'jobs' => $jobs,
        ]);
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        /** @var array $validated */
        $validated = $request->validated();

        $student = loggedUser();

        /** @var int $contactId */
        $contactId = $contact->getKey();

        $validated['user_id'] = $student->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 403);

        $this->contactRepository->updateContact($validated, $contact);

        return redirect(route('student.contacts.index'))->with('success', $contact->firstname.' '.$contact->name.' a bien été modifiée !');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $student = loggedUser();

        /** @var int $contactId */
        $contactId = $contact->getKey();

        abort_if($this->studentRepository->checkStudentHasThisContact($student, $contactId), 404);

        $this->contactRepository->deleteContact($contact);

        return redirect(route('student.contacts.index'))->with('success', 'Le contact '.$contact->firstname.' '.$contact->name.' a bien été supprimée !');
    }
}
