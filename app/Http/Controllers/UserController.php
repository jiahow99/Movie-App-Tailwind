<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Callback from API authenticating request token
     */
    public function authenticate_token(Request $request)
    {
        // $url = 'https://api.themoviedb.org/3/authentication/session/new' ;
        
        // // Get reqeust token
        // if( Redis::exists('request_token') )
        // {
        //     $data = [
        //         'request_token' => Redis::get('request_token')
        //     ];
        // }else{
        //     abort(401, 'Unauthorized request token');
        // }

        // // Exchange for session ID
        // $request = Http::withToken(config('services.tmdb.token'))
        //     ->post($url, $data)->json();

        dd($request);
    }
}
