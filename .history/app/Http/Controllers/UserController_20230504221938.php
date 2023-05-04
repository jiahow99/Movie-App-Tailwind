<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Callback from API authenticating request token
     */
    public function authenticate_token(string $request_token)
    {
        $url = 'https://api.themoviedb.org/3/authentication/session/new' ;
        
        // Get reqeust token
        if( Redis::exists('request_token') )
        {
            $data = [
                'request_token' => Redis::get('request_token')
            ];
        }
    }
}
