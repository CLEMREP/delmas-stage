<?php

if (!function_exists('loggedUser')) {
    function loggedUser(): \App\Models\User
    {
        if (!auth()->check()) {
            throw new \Illuminate\Auth\AuthenticationException();
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user;
    }
}