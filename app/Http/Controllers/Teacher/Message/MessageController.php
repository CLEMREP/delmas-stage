<?php

namespace App\Http\Controllers\Teacher\Message;

use App\Http\Controllers\Controller;
use App\Repositories\TeacherRepository;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function __construct(private TeacherRepository $teacherRepository)
    {
    }

    public function index(): View
    {
        $user = loggedUser();

        return view('delmas.teacher.message.index', [
            'title' => 'Message',
            'students' => $this->teacherRepository->allStudents($user),
        ]);
    }
}
