<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Enums\Roles;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()?->hasVerifiedEmail()) {
            $route = match ($request->user()->role) {
                Roles::Admin => 'admin.index',
                Roles::Teacher => 'teacher.index',
                default => 'student.index',
            };

            return redirect()->intended($route);
        }

        $request->user()?->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
