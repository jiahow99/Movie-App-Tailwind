<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Callback from API authenticating request token
     */
    public function authenticate_token(string $request_token)
    {
        $url = 'https://api.themoviedb.org/3/authentication/session/new'
    }
}
