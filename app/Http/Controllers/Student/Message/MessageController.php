<?php

namespace App\Http\Controllers\Student\Message;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('delmas.student.message.index', [
            'title' => 'Message',
        ]);
    }
}
