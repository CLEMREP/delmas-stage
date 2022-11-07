<?php

namespace App\Http\Controllers\Teacher\Message;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function __construct(private TeacherRepository $teacherRepository)
    {
    }

    public function index(): View
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return view('delmas.teacher.message.index', [
            'title' => 'Message',
            'students' => $this->teacherRepository->allStudents($teacher),
        ]);
    }
}
