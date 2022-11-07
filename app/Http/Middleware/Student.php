<?php

namespace App\Http\Middleware;

use App\Models\Enums\Roles;
use Closure;
use Illuminate\Http\Request;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (loggedUser()->role == Roles::Student)
        {
            return $next($request);
        }

        return abort(403, 'Vous n\'avez pas la permission.');
    }
}
