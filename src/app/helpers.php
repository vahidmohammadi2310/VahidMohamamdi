<?php

use Illuminate\Support\Facades\Auth;

function isAdmin()
{
    $result = false;
    $user = Auth::user();
    if($user->role == 'Administrator')
        $result = true;

    return $result;
}
